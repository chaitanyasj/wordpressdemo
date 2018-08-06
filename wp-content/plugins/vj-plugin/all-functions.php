<?php

    class jobs {
        private $table_name;
        public function __construct() {
            global $wpdb;
            $this->table_name = $wpdb->prefix . 'enggwave_jobs_data';
            $this->apiURL = 'https://www.enggwave.com/wp-json/wp/v2/posts/?per_page=100';
            $all_ids = $wpdb->get_results( 'SELECT job_id FROM '. $this->table_name);
            foreach($all_ids as  $ids){
                $job_ids[] = $ids->job_id;
            }

            $this->job_ids = $job_ids;
            // add_shortcode('demoview',array($this,'demoview'));
            // $this->createJobTable();
            // $this->dropTable();
                    
        }
         function dropTable() {
            global $wpdb;
            $delete = $wpdb->query("DROP TABLE $this->table_name");
        }
       
        public function createJobTable() {
            global $wpdb;
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $this->table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT, 
                job_id mediumint(9) NOT NULL,  
                title text NOT NULL, 
                content text NOT NULL,
                excerpt text NOT NULL,
                jdate text NOT NULL,
                categories varchar(255) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";


            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
        function insertJobData($data) {
            global $wpdb;  
            if (!in_array($data->id,$this->job_ids)) {
                $wpdb->insert(
                $this->table_name, array(
                'job_id'     => $data->id,
                'title'      => $data->title->rendered,
                'content'    => $data->content->rendered,
                'excerpt'    => $data->excerpt->rendered,
                'jdate'      => $data->date, 
                'categories' => implode(',',$data->categories)
                ), array(
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s'
                    )
                );
            }   
        }  
        function displayJobData(){
            global $wpdb;  
            $all_jobs_listing = $wpdb->get_results( 'SELECT * FROM '. $this->table_name);
            // echo "<pre>";
            // print_r($all_jobs_listing);
            echo "<div class='job-view'>";
            foreach ($all_jobs_listing as $value) {
                // print_r($value);
             // echo $value->title."<br>";
             echo $value->content."<br>";
             echo $value->excerpt."<br>";
             // echo $value->link."<br>";
             echo "</div>";
            }
        }
    }

