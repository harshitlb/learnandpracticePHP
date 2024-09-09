<?php

add_action('rest_api_init', function () {
    register_rest_route('wp-booking/v1', '/bookings', array(
        'methods' => 'GET',
        'callback' => 'wp_booking_get_all_bookings',
    ));

    register_rest_route('wp-booking/v1', '/bookings/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'wp_booking_get_booking',
    ));

    register_rest_route('wp-booking/v1', '/bookings', array(
        'methods' => 'POST',
        'callback' => 'wp_booking_create_booking',
    ));

    register_rest_route('wp-booking/v1', '/bookings/(?P<id>\d+)', array(
        'methods' => 'PUT',
        'callback' => 'wp_booking_update_booking',
    ));

    register_rest_route('wp-booking/v1', '/bookings/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'wp_booking_delete_booking',
    ));
});

// CRUD Operation Functions

// Get All Bookings
function wp_booking_get_all_bookings(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'Booking';

    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    
    if ($wpdb->last_error) {
        return new WP_REST_Response(array(
            'message' => 'Failed to retrieve bookings.',
            'error' => $wpdb->last_error,
            'status' => 500
        ), 500);
    }

    return new WP_REST_Response(array(
        'message' => 'Bookings retrieved successfully.',
        'data' => $results,
        'status' => 200
    ), 200);
}

// Get Single Booking by ID
function wp_booking_get_booking(WP_REST_Request $request) {
    global $wpdb;
    $id = intval($request['id']); // Sanitize the input ID
    $table_name = $wpdb->prefix . 'Booking';

    $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id), ARRAY_A);

    if (is_null($result)) {
        return new WP_REST_Response(array(
            'message' => 'Booking not found.',
            'status' => 404
        ), 404);
    }

    if ($wpdb->last_error) {
        return new WP_REST_Response(array(
            'message' => 'Failed to retrieve booking.',
            'error' => $wpdb->last_error,
            'status' => 500
        ), 500);
    }

    return new WP_REST_Response(array(
        'message' => 'Booking retrieved successfully.',
        'data' => $result,
        'status' => 200
    ), 200);
}

// Create a New Booking
function wp_booking_create_booking(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'Booking';

    $user_id = isset($request['user_id']) ? intval($request['user_id']) : null;
    $booking_date = isset($request['booking_date']) ? sanitize_text_field($request['booking_date']) : null;
    $status = isset($request['status']) ? sanitize_text_field($request['status']) : null;
    $details = isset($request['details']) ? sanitize_textarea_field($request['details']) : null;

    if (is_null($user_id) || empty($booking_date) || empty($status)) {
        return new WP_REST_Response(array(
            'message' => 'Missing required fields: user_id, booking_date, and status are mandatory.',
            'status' => 400
        ), 400);
    }


    $result = $wpdb->insert($table_name, array(
        'user_id' => $user_id,
        'booking_date' => $booking_date,
        'status' => $status,
        'details' => $details
    ), array('%d', '%s', '%s', '%s')); 


    if ($result === false) {
        return new WP_REST_Response(array(
            'message' => 'Database insert failed.',
            'error' => $wpdb->last_error,
            'status' => 500
        ), 500);
    }

  
    return new WP_REST_Response(array(
        'message' => 'Booking created successfully.',
        'booking_id' => $wpdb->insert_id,
        'status' => 201
    ), 201);
}

// Update an Existing Booking
function wp_booking_update_booking(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'Booking';

    $id = intval($request['id']);
    $user_id = isset($request['user_id']) ? intval($request['user_id']) : null;
    $booking_date = isset($request['booking_date']) ? sanitize_text_field($request['booking_date']) : null;
    $status = isset($request['status']) ? sanitize_text_field($request['status']) : null;
    $details = isset($request['details']) ? sanitize_textarea_field($request['details']) : null;

    $existing_booking = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id), ARRAY_A);
    if (is_null($existing_booking)) {
        return new WP_REST_Response(array(
            'message' => 'Booking not found.',
            'status' => 404
        ), 404);
    }

 
    $updated = $wpdb->update($table_name, array(
        'user_id' => $user_id,
        'booking_date' => $booking_date,
        'status' => $status,
        'details' => $details
    ), array('id' => $id), array('%d', '%s', '%s', '%s'), array('%d'));

    
    if ($updated === false) {
        return new WP_REST_Response(array(
            'message' => 'Failed to update booking.',
            'error' => $wpdb->last_error,
            'status' => 500
        ), 500);
    }

    if ($updated === 0) {
        return new WP_REST_Response(array(
            'message' => 'No changes were made to the booking.',
            'status' => 200
        ), 200);
    }

 
    return new WP_REST_Response(array(
        'message' => 'Booking updated successfully.',
        'status' => 200
    ), 200);
}


// Delete a Booking
function wp_booking_delete_booking(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'Booking';

 
    $id = intval($request['id']);

   
    $existing_booking = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id), ARRAY_A);
    if (is_null($existing_booking)) {
        return new WP_REST_Response(array(
            'message' => 'Booking not found.',
            'status' => 404
        ), 404);
    }


    $deleted = $wpdb->delete($table_name, array('id' => $id), array('%d'));


    if ($deleted === false) {
        return new WP_REST_Response(array(
            'message' => 'Failed to delete booking.',
            'error' => $wpdb->last_error,
            'status' => 500
        ), 500);
    }


    return new WP_REST_Response(array(
        'message' => 'Booking deleted successfully.',
        'status' => 200
    ), 200);
}

?>
