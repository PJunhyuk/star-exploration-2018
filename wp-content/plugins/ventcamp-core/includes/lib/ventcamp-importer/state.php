<?php

/**
 * Class Importer_Stats.
 *
 * Class to track status of each task.
 */
class Importer_Stats {
    // Holds an instance of Importer_Stats
    private static $instance;
    // Array of stats of the importer
    protected $stats = array();
    // The state which is currently on
    protected $current_state;
    // Saves microtime to calculate execution time
    protected $time_start;

    /**
     * Access the single instance of this class
     * @return Importer_Stats
     */
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new Importer_Stats();
        }
        return self::$instance;
    }

	/**
	 * ImporterInitialState constructor.
	 */
	public function __construct() {
		// Restore variables before import begins
		$this->restore_saved_stats();
	}

    /**
     * Get previously saved variables
     */
    public function restore_saved_stats() {
        // Get saved array of stats
        $this->set_stats( get_option( 'ventcamp_importer_stats' ) );
        // Get saved current stat
        $this->set_current_state( get_option( 'ventcamp_importer_current_state' ) );

        // If stats array is empty, set current state to 'initial'
        $stats = $this->get_stats();
        if ( empty($stats ) ) {
            $this->set_current_state( 'initial' );
        }
    }

    /**
     * Getter for $stats variable
     *
     * @return array An array of stats with results
     */
    public function get_stats() {
        return $this->stats;
    }

    /**
     * Setter for $stats variable
     *
     * @param array $stats A new array of stats
     */
    public function set_stats( $stats ) {
        $this->stats = $stats;
    }

    /**
     * Start import process, init our working state
     */
    public function start_state() {
        // Clear previous stats
        $this->set_stats( array() );
        // Set current state to 'working'
        $this->set_current_state( 'working' );
        // Set initial task start time
        $this->time_start = microtime( true );
    }

    /**
     * Setter for a single state
     *
     * @param string $name Name of the state
     * @param string $message Message to the user
     * @param string $result Result of the state (success/failed)
     * @param string $time Execution time
     */
    public function set_single_state( $name, $message, $result, $time ) {
        // Only if name of the state is not empty
        if ( ! empty( $name ) ) {
            // The only allowed values
            $allowed_results = array( 'success', 'failed' );
            // Check if status has a valid name
            $result = in_array( $result, $allowed_results ) ? $result : '';
            // Get full result string
            $full = $this->get_formatted_status_result( $result );

            // Add a new element
            $this->stats[] = array(
                // Set state name
                'name'       => $name,
                // Set state message
                'message'    => $message,
                // Set state result
                'status'     => $result,
                // Set formatted status result
                'statusfull' => $full,
                // Set execution time
                'duration'   => $time
            );
        }
    }

    /**
     * Convert result ID into human-readable format
     *
     * @param string $result Result of the task execution
     *
     * @return string Formatted status result
     */
    protected function get_formatted_status_result( $result ) {
        switch ($result) {
            // Task successfully completed
            case 'success' :
                return '<span class="dashicons dashicons-yes status-success"></span> ' . __( 'Complete', 'ventcamp' );
                break;

            // Task completed unsuccessfully
            case 'failed' :
                return '<span class="dashicons dashicons-yes status-failed"></span> ' . __( 'Failed', 'ventcamp' );
                break;

            // Pending task
            case 'pending' :
                return '<div class="status-bar"><span class="status-value"></span></div>';
                break;

        }

        return '';
    }

    /**
     * Getter for $current_state variable
     *
     * @return string The pointer to the current state
     */
    public function get_current_state() {
        return $this->current_state;
    }

    /**
     * Setter for $current_state variable
     *
     * @param string $current_state Name of the current state
     */
    public function set_current_state( $current_state ) {
        $this->current_state = $current_state;
    }

    /**
     * Reset all current settings
     */
    public function reset_stats() {
        // Re-init the array of stats
        $this->set_stats( array() );
        // Set current state to 'reset'
        $this->set_current_state( 'reset' );

        // Delete options
        delete_option( 'ventcamp_importer_stats' );
        delete_option( 'ventcamp_importer_current_state' );
    }

    /**
     * Make transition to the next state, for example 'content' -> 'menus' -> 'widgets'
     *
     * @param string $name State to switch to.
     * @param string $message Message to the user
     * @param string $result Result of specified operation
     *
     * @throws Exception If specified state is invalid
     */
    public function set_state( $name, $message, $result ) {
        // State is changed, get the end time
        $time_end = microtime( true );
        // Calculate the total execution time
        $execution_time = round( $time_end - $this->time_start, 2 ) . "s";

        // Check the name of the state
        switch ( $name ) {
            // Allowed stats
            case "libraries" :
            case "demofile" :
            case "pages" :
            case "content" :
            case "menus" :
            case "widgets" :
            case "options" :
            case "theme" :
                // Set state
                $this->set_single_state( $name, $message, $result, $execution_time );
                // Set pointer to the current state
                $this->set_current_state( $name );
                break;

            // Unknown state, show an error
            default:
                throw new Exception( __( "Transition error, state '" . $name . "' is not a valid state for this importer", 'ventcamp' ) );
        }

        // Update the start time
        $this->time_start = microtime( true );
    }

    /**
	 * Finish import and save the variables
	 *
	 */
	public function finish_state() {
        // Set current state to finished
        $this->set_current_state( 'finished' );
        // Save variables after import end
        $this->save_stats();
	}

    /**
     * Update options after the last state
     */
    public function save_stats() {
        // Update stats
        update_option( 'ventcamp_importer_stats', $this->get_stats() );
        // Update current state
        update_option( 'ventcamp_importer_current_state', $this->get_current_state() );
    }
}