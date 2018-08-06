<?php 
// $quiz_results : ALL QUIZZES RESULTS STORED BY PLUGIN(LEARNDASH).
// $rev_quiz_results : REVERSE OF $quiz_results.(TO GET LATEST UPDATED VALUE).
// $graph array : RESULT OF GIVEN QUIZZES UNDER LESSONS.
// $course_info : TOTAL SCORE AND AVERAGE SCORE FOR ALL LESSON.
// $test_quiz_cat_result : ALL QUIZZES RESULTS CATEGORY WISE UNDER TESTS.

// FOR QUIZZES UNDER LESSONS
    global $wpdb;
	$quiz_results = get_user_meta( get_current_user_id(), '_sfwd-quizzes', true );
	$rev_quiz_results = array_reverse($quiz_results);
    $test_quiz_cat_result = get_user_meta(get_current_user_id(),'tests_category_result',true);
    // echo "<pre>";
    // print_r($rev_quiz_results); die;

    //CODE FOR 3RD GRAPH
    $question_category = $wpdb->get_results('SELECT * FROM wp_wp_pro_quiz_category');
    $args1 = array(
    'post_type' => 'sfwd-quiz',
    'cat' => '23',
    'orderby'=>'menu_order',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'fields' => 'ids'
    );
 $my_query1 = new WP_Query( $args1 );

   // if(get_current_user_id() == 29){
      // $quiz_results = get_user_meta( get_current_user_id(), '_sfwd-quizzes', true );
/*
       $quiz_results[0]['time'] = 1509508800;
       $quiz_results[0]['percentage'] = 50;
       $quiz_results[0]['score'] = 40;

       $quiz_results[1]['time'] = 1511154000;
       $quiz_results[1]['percentage'] = 90;
       $quiz_results[1]['score'] = 72;
       $quiz_results[1]['pass'] = 1;

        $quiz_results[2]['time'] = 1512104400;
        $quiz_results[2]['percentage'] = 100;
        $quiz_results[2]['score'] = 79;
        $quiz_results[2]['pass'] = 1;

        $quiz_results[3]['time'] = 1513746000;

        $quiz_results[4]['time'] = 1514782800;
        $quiz_results[4]['percentage'] = 50;
        $quiz_results[4]['score'] = 40;

        $quiz_results[5]['time'] = 1516424400;
        $quiz_results[5]['percentage'] = 85;
        $quiz_results[5]['score'] = 68;
        $quiz_results[5]['pass'] = 1;

        $quiz_results[6]['time'] = 1517461200;
        $quiz_results[6]['percentage'] = 90;
        $quiz_results[6]['score'] = 72;
        $quiz_results[6]['pass'] = 1;

        $quiz_results[9]['time'] = 1517979600;
        $quiz_results[9]['percentage'] = 100;
        $quiz_results[9]['score'] = 80;
        $quiz_results[9]['pass'] = 1;

        $quiz_results[7]['time'] = 1517806800;
        $quiz_results[7]['percentage'] = 25;
        $quiz_results[7]['score'] = 20;

        $quiz_results[8]['time'] = 1517893200;
        $quiz_results[8]['percentage'] = 100;
        $quiz_results[8]['score'] = 80;
        $quiz_results[8]['pass'] = 1;


$quiz_results[5]['percentage'] = 85;
$quiz_results[8]['percentage'] = 85;
$quiz_results[7]['percentage'] = 85;
$quiz_results[9]['percentage'] = 85;

$quiz_results[0]['percentage'] = 50;
$quiz_results[1]['percentage'] = 25;
$quiz_results[0]['score'] = 40;
$quiz_results[1]['score'] = 20;

$quiz_results[4]['percentage'] = 50;
$quiz_results[4]['score'] = 40;

$quiz_results[9]['percentage'] = 25;
$quiz_results[9]['score'] = 20;


$quiz_results[7]['percentage'] = 25;
$quiz_results[7]['score'] = 20;

$quiz_results[4]['percentage'] = 25;
$quiz_results[4]['score'] = 20;





      $quiz_results[0]['time'] = 1517634000;


       $quiz_results[4]['percentage'] = 90;
       $quiz_results[4]['score'] = 72;
       $quiz_results[4]['pass'] = 1;

       $quiz_results[1]['time'] = 1511154000;

        $quiz_results[3]['percentage'] = 100;
        $quiz_results[3]['score'] = 80;
        $quiz_results[3]['pass'] = 1;

        $quiz_results[2]['time'] = 1512882000;

$quiz_results[3]['time'] = 1515128400;
$quiz_results[4]['time'] = 1515214800;

         $quiz_results[5]['percentage'] = 65;
         $quiz_results[5]['score'] = 68;
         $quiz_results[5]['pass'] = 1;
         $quiz_results[5]['time'] = 1517288400;

         $quiz_results[6]['percentage'] = 65;
         $quiz_results[6]['score'] = 68;
         $quiz_results[6]['pass'] = 1;
         $quiz_results[6]['time'] = 1517461200;
 
$quiz_results[7]['percentage'] = 65;
        $quiz_results[7]['score'] = 68;
        $quiz_results[7]['pass'] = 1;
$quiz_results[7]['time'] = 1517806800;

    $quiz_results[8]['percentage'] = 90;
       $quiz_results[8]['score'] = 72;
       $quiz_results[8]['pass'] = 1;
       $quiz_results[8]['time'] = 1517893200;

        $quiz_results[9]['percentage'] = 65;
        $quiz_results[9]['score'] = 68;
        $quiz_results[9]['pass'] = 1;
        $quiz_results[9]['time'] = 1517979600;

*/

       // $quiz_results[9]['time'] = 1517979600;   
        // $quiz_results[1]['percentage'] = 100;
        // $quiz_results[1]['score'] = 78;
        // $quiz_results[1]['pass'] = 1;
    //     $quiz_results[2]['percentage'] = 90;
    //     $quiz_results[2]['score'] = 75;
    //     $quiz_results[2]['pass'] = 1;
    //     $quiz_results[3]['percentage'] = 100;
    //     $quiz_results[3]['score'] = 77; 
    //     $quiz_results[3]['pass'] = 1; 
           
  // update_user_meta( get_current_user_id(), '_sfwd-quizzes', $quiz_results);
       //     echo "<pre>";
  //   print_r($quiz_results); 
/*foreach($quiz_results as $test) {
   echo date("M d Y",$test['time']).' => '.get_the_title($test['quiz']).' => '.$test['score'].' => '.$test['percentage'].'<br>';
}*/
   //  die;
    // }

    $progress = 0;
    // echo "<pre style='display:none;'>";
    // print_r($my_query1->posts);
    // print_r($test_quiz_cat_result); 
    // echo "</pre>";
    // die;

    $preparedness_level_indicator = array();
    $thirty_days_before = strtotime('-30 days');
    // echo $thirty_days_before;
    foreach ($rev_quiz_results as $key => $value) {
        if ($thirty_days_before < $value['time']) {
            $temp_key = $value['quiz'];
            $preparedness_level_indicator[$temp_key]['quiz'] = $value['quiz'];
            $preparedness_level_indicator[$temp_key]['pass'] = $value['pass'];
            $preparedness_level_indicator[$temp_key]['time'] = $value['time'];

        }
    }
    // echo "<pre>";
    // print_r($rev_quiz_results); die;
 //    foreach($rev_quiz_results as $test) {
	//    echo date("M d Y",$test['time']).' => '.get_the_title($test['quiz']).' => '.$test['pass'].'<br>';
	// }
 //    echo "<br><br>One month filter<br>";
    // foreach($preparedness_level_indicator as $test) {
    //    echo date("M d Y",$test['time']).' => '.get_the_title($test['quiz']).' => '.$test['pass'].'<br>';
    // }

    foreach ($preparedness_level_indicator as $indicator_key => $indicator_value) {
    	$sixteen_days_before = strtotime ( '-30 days' ,$indicator_value['time']);
        $got_first_time = 0;
		foreach ($rev_quiz_results as $key => $value) {
	        if ($sixteen_days_before < $value['time'] && $indicator_key == $value['quiz'] && $value['time'] != $indicator_value['time']) {
	        	// echo "if( ".date("M d Y",$sixteen_days_before)." < ".date("M d Y", $value['time'])." => ".get_the_title($value['quiz'])."<br>";
                $got_first_time = $got_first_time + 1;
                if($got_first_time == 2){
                	// echo "<pre>";
                	// print_r($value);
                    unset($preparedness_level_indicator[$indicator_key]);
                }
	        }
	    }
	}
	// echo "<pre>";
	// print_r($preparedness_level_indicator);
	// echo "<br><br>Processed<br>";
	// foreach($preparedness_level_indicator as $test) {
	//    echo date("M d Y",$test['time']).' => '.get_the_title($test['quiz']).' => '.$test['pass'].'<br>';
	// }

    if(count($preparedness_level_indicator) >= 4){
        foreach ($preparedness_level_indicator as $key => $value) {
                // echo date("Y-m-d",$value['time']);
            if(in_array($key, $my_query1->posts) && !in_array($key,$preparedness_level_indicator)){
                if($value['pass'] == 1){
                    $progress = $progress + 1;
                }
            }
                // echo $value['quiz'].'=>',date('Y-m-d',$value['time']);
        }
    }else{
        $progress = -1;
    }
    // echo 'progress '.$progress;
    // $progress = 4;
    // die;
    ?>
<?php //die;} ?> 
    <?php
	$graph_array = array();
	$course_info = array();
    $args = array(
        'post_type' => 'sfwd-quiz',
        'cat' => '27',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'post_status' => 'publish',
        'fields' => 'ids'
    );
    $my_query = new WP_Query( $args );

    $courses_args = array(
        'post_type' => 'sfwd-courses',
        'orderby'=>'menu_order',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'fields' => 'ids'
    );
    $courses_ids = new WP_Query( $courses_args ); 
    // echo "<pre>";
    // print_r($my_query->posts);
    foreach ($my_query->posts as $key1 => $fs_current_id) {
		$course_id = get_post_meta($fs_current_id,'course_id');
    	if(array_search($fs_current_id, array_column($rev_quiz_results, 'quiz')) !== false) {
				foreach ($rev_quiz_results as $key => $value) {
					if($value['quiz'] == $fs_current_id){
						$new_array['id'] = $fs_current_id;
						$new_array['title'] = get_the_title($fs_current_id);
						$pass = ( $value['pass'] == 1 ) ? 1 : 0;
						$new_array['pass'] = $pass;
						$new_array['score'] = $score = $value['score'];
                        $new_array['percentage'] = $score = $value['percentage'];
						$new_array['course_id'] = $course_id[0];
						$new_array['given'] = 1;
						$graph_array[$course_id[0]][] = $new_array;
						break;
					}
				}
		}else {
            //TEST NOT FACED TILL NOW
			$new_array['id'] = $fs_current_id;
			$new_array['title'] = get_the_title($fs_current_id);
			$new_array['course_id'] = $course_id[0];
			$new_array['given'] = 0;
			$graph_array[$course_id[0]][] = $new_array;
		}
    }
    // echo "<pre style='display:none;'>";
    // // print_r($graph_array);
    // foreach ($graph_array as $key => $value) {
    //     // echo sizeof($value);
    //     foreach ($value as $key1 => $value1) {
    //         echo $value1['title'];
    //     }
    //     // print_r($value);
    // }
    // echo "</pre>";
    // die;
    $total_score = 0;
    $no_of_present_quiz = 0;
    foreach ($graph_array as $course_key => $course_value) {
    	foreach ($course_value as $quiz_key => $quiz_value) {
            if ($quiz_value['given'] == 1) {                
    	    	$total_score = $total_score + $quiz_value['percentage'];
    	    	$no_of_present_quiz = $no_of_present_quiz + 1;
            }
    	}
        // if($total_score != 0 ){
    	   $course_info[$course_key]['score'] = $total_score;
        // }
    	$average_score = $total_score / $no_of_present_quiz;
        // if($average_score != 0 ){
    	   $course_info[$course_key]['average'] = round($average_score,2);
        // }
    	$total_score = 0;
        $no_of_present_quiz = 0;
    }
    $raw = array_filter($course_info);



$demo_data = array(54, 59, 49, 51, 79, 43, 83, 90, 37, 78, 88, 76, 63, 94, 42, 50, 74, 90, 40, 76);
$demo_data1 = array(71, 94, 100, 60, 75, 88, 62, 58, 98, 92, 93, 59, 86, 47, 75, 61, 30, 65, 49);

?>
<h2>Reports</h2>   
<div class="fs-first-graph-container">
    <h4 class="fs-container-header">1. Lesson Quiz Performance (Topic Average Quiz Scores)</h4>
    <p>This graph displays your average score in quizzes for each topic.</p>
     <?php if (empty($raw)) { ?>
     <div class="fs-no-data-present"><p>No data present</p></div>
     <?php } ?>
    <div class="chart-container">
          <canvas id="myChart"></canvas>
    </div>
</div>

<div class="fs-second-graph-container">
    <h4 class="fs-container-header">2. Lesson Quiz Performance (Topic Individual Quiz Scores)</h4>
    <p>Use the drop down menu to display individual scores in all quizzes taken for each topic.</p>
    <?php if (empty($raw)) { ?>
             <div class="fs-no-data-present"><p>No data present</p></div>
             <style type="text/css">select#TestCat {display: none; } </style>
    <?php } ?>
         <select id="TestCat">
        <?php
         foreach ($courses_ids->posts as $key => $value) {
            foreach ($course_info as $ckey => $cvalue) {
                if($value == $ckey){
                  $title = get_the_title($ckey);
                  echo '<option value="'.$ckey.'">'.$title.'</option>';
                }
            }
         }
         ?>
        </select>
        <div class="chart-container2">
            <canvas id="lessonChart"></canvas>
        </div>
</div>
<div class="fs-third-graph-container">
    <h4 class="fs-container-header">3. Test Scores Performance (Tests/Topic Scores)</h4>
    <p>Use the drop down menu to display scores in all tests or scores in each topic on all tests.</p>
    <?php if (empty($raw)) { ?>
            <div class="fs-no-data-present"><p>No data present</p></div>
            <style type="text/css">select#selectTest {display: none; } </style>
    <?php } ?>
            <select id="selectTest">
            <option value="all">All</option>
            <?php
             foreach ($courses_ids->posts as $key => $value) {
                foreach ($course_info as $ckey => $cvalue) {
                    if($value == $ckey){
                        $title = get_the_title($ckey);
                        foreach ($question_category as $catvalue) {
                            if($title == $catvalue->category_name){
                                echo '<option value="'.$catvalue->category_id.'">'.$catvalue->category_name.'</option>';
                            }
                        }
                    }
                }
             }
              ?>
            </select>
            <div class="chart-container3">
                <canvas id="testChart"></canvas>
            </div>
</div>
<div class="preparedness-container">
    <h4 class="fs-container-header">4. Preparedness Level Indicator</h4>
    <?php
    if($progress == -1){
        echo '<div class="cb-progressbar">
            <div style="background-color:#eee;height:35px;border-radius:8px;border: 2px solid #111;" class="cb-progressbar-bar">
            <div class="cb-progress-bar-content" style="width:100%;background-color:#fff;border-radius:8px;height: 100%;border: 2px solid #111;" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="70">
            </div>
        </div> 
        <span class="progress-title" style="color:#000000;">
            <span class="cb-progressbar-text">INSUFFICIENT INFORMATION</span>
        </span>
        </div>';
        echo '<div class="cb-prepare-text">
        <p>Recommendation: You need to complete at least four unique full length practice tests (not quizzes) within the last 30 days to provide enough data to estimate your level of preparedness.</p>
        </div>';
        
    }elseif($progress == 0 || $progress == 1){
        echo '<div class="cb-progressbar">
            <div style="background-color:#eee;height:35px;border-radius:8px;border: 2px solid #111;" class="cb-progressbar-bar">
            <div class="cb-progress-bar-content" style="width:30%;background-color:#fc3030;border-radius:8px;height: 100%;border: 2px solid #111;" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="70">
            </div>
        </div> 
        <span class="progress-title" style="color:#000000;">
            <span class="cb-progressbar-text">NOT READY</span>
        </span>
        </div>';
        echo '<div class="cb-prepare-text">
        <p>Recommendation: Inadequate mastery. Please read the lessons and take practice quizzes to master the tested topics. Retake the tests after you have completed all lessons and practice quizzes. Repeated review and practice will help you gain mastery over time.</p>
        </div>';

    }elseif($progress == 2 || $progress == 3){
        echo '<div class="cb-progressbar">
            <div style="background-color:#eee;height:35px;border-radius:8px;border: 2px solid #111;" class="cb-progressbar-bar">
            <div class="cb-progress-bar-content" style="width:70%;background-color:#ffd833;border-radius:8px;height: 100%;border: 2px solid #111;" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="70">
            </div>
        </div> 
        <span class="progress-title" style="color:#000000;">
            <span class="cb-progressbar-text">NEARLY READY</span>
        </span>
        </div>';
        echo '<div class="cb-prepare-text">
        <p>Recommendation: You are making good progress. Review the reports to identify topics where you need to gain deeper understanding. Read those lessons and take more practice quizzes before taking the tests again.</p>
        </div>';               
    }elseif($progress >= 4){
        echo '<div class="cb-progressbar">
            <div style="background-color:#eee;height:35px;border-radius:8px;border: 2px solid #111;" class="cb-progressbar-bar">
            <div class="cb-progress-bar-content" style="width:100%;background-color:#79e233;border-radius:8px;height: 100%;">
            </div>
        </div> 
        <span class="progress-title" style="color:#000000;">
            <span class="cb-progressbar-text">READY</span>
        </span>
        </div>';
        echo '<div class="cb-prepare-text">
        <p>Recommendation: You appear well prepared to take the test. Continue study and practice to maintain your preparedness. Make sure to get adequate rest and do not practice a day before your test.</p>
        </div>';
    }
    ?>
</div>
<!-- 
<div class="result-page-interpretation">
    <h5>Interpretation of results & Recommendations:</h5>
<table>
<tr>
    <td>
        <span class="red"></span>        
    </td>
    <td>
        <p>A red bar indicates inadequate mastery of the material. It is recommended that the user review study material and retake quizzes on all topics with red bars.</p>        
    </td>
</tr>
<tr>
    <td>
        <span class="yellow"></span>        
    </td>
    <td>
        <p>A yellow bar indicates almost adequate mastery of the material. It is recommended that the user revise the study material and take more quizzes to achieve mastery and reach passing score.</p>       
    </td>
<tr>
    <td>
        <span class="green"></span>        
    </td>
    <td>
        <p>A green bar indicates currently adequate mastery of the material which is likely to be sufficient to obtain a passing score. However, continuous review and test practice is recommended to ensure preparedness until the exam.</p>        
    </td>
</tr>
</table>
</div>
 -->

<script>
// FOR 1ST GRAPH
var ctx = document.getElementById("myChart").getContext("2d");
var data = {
    labels: [<?php
        foreach ($courses_ids->posts as $key => $value) {
            $abbr = get_field('abbreviation',$value);
            echo '"'.$abbr.'",';
        }
        ?>],
        datasets: [{
            label: 'Average %',
            data: [<?php
            
            if(get_current_user_id() == 2){
            for ($i=0; $i < 16 ; $i++) { 
                 echo '"'.$demo_data[$i].'",';
            }
            }
            else{
            foreach ($courses_ids->posts as $key => $value) {
                foreach ($course_info as $ckey => $cvalue) {
                    if($value == $ckey){
                        echo '"'.$cvalue['average'].'",';
                    }
                }
            }
        }
            ?>],
            backgroundColor: [
            <?php
            if(get_current_user_id() == 2){
            for ($i=0; $i < 16 ; $i++) { 
                 if ($demo_data[$i] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($demo_data[$i] < 75 && $demo_data[$i] >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($demo_data[$i] <50){ echo "'rgba(255, 0, 0, 0.8)',"; }
            }
        }else{

            foreach ($courses_ids->posts as $key => $value) {
                foreach ($course_info as $ckey => $cvalue) {
                    if($value == $ckey){
                        if ($cvalue['average'] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($cvalue['average'] < 75 && $cvalue['average'] >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($cvalue['average'] <50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                    }
                }
            }
        }
            ?>],
            borderColor: [
            <?php

            if(get_current_user_id() == 2){
             for ($i=0; $i < 16 ; $i++) { 
               echo "'rgba( 0, 0, 0, 1)',";
            }
        }else{

            foreach ($courses_ids->posts as $key => $value) {
                foreach ($course_info as $ckey => $cvalue) {
                    if($value == $ckey){
                        if ($cvalue['average'] >= 75) { echo "'rgba( 0, 0, 0, 1)',"; }elseif($cvalue['average'] <75 && $cvalue['average'] >= 50){ echo "'rgba( 0, 0, 0, 1)',"; }elseif($cvalue['average'] < 50){ echo "'rgba( 0, 0, 0, 1)',"; }
                    }
                }
            }
        }
            ?>],
            borderWidth: 1
        }]
    }
    if (window.matchMedia('screen and (max-width: 480px)').matches) {
        var options = {
            scales: {
                xAxes: [{
                    barThickness: 10,
                    ticks: {
                        fontSize: 7,
                        beginAtZero:true,
                        fontColor: 'black'
                    }
                }],
                yAxes: [{
                    ticks: {
                        fontSize: 7,
                        min: 0,
                        max: 100,                    
                        beginAtZero:true,
                        fontColor: 'black'
                    },
                    scaleLabel: {
                       display: true,
                       labelString: "Average Score",
                       fontSize: 7
                   }
                }]
            },
            legend: {
            display: false
        },
        responsive: true,
        }

        var options2 = {
            scales: {
                xAxes: [{
                    barThickness: 10,
                    ticks: {
                        fontSize: 7,
                        beginAtZero:true,
                        fontColor: 'black'
                    }
                }],
                yAxes: [{
                    ticks: {
                        fontSize: 7,
                        min: 0,
                        max: 100,
                        beginAtZero:true,
                        fontColor: 'black'
                    },
                    scaleLabel: {
                       display: true,
                       labelString: "Score",
                       fontSize: 7
                   }
                }]
            },
            legend: {
            display: false
            }
       }
    }else{
           var options = {
                scales: {
                    xAxes: [{
                        barThickness: 30,
                        ticks: {
                            beginAtZero:true,
                            fontColor: 'black'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 100,                    
                            beginAtZero:true,
                            fontColor: 'black'
                        },
                        scaleLabel: {
                           display: true,
                           labelString: "Average Score"
                       }
                    }]
                },
                legend: {
                    display: false
            },
            responsive: true,
            }
        var options2 = {
            scales: {
                xAxes: [{
                    barThickness: 30,
                    ticks: {
                        beginAtZero:true,
                        fontColor: 'black'
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100,
                        beginAtZero:true,
                        fontColor: 'black'
                    },
                    scaleLabel: {
                       display: true,
                       labelString: "Score"
                   }
                }]
            },
            legend: {
                display: false
            }
        }
    }
var myChart = new Chart(ctx,{
    type: 'bar',
    data: data,
    options: options
});

//FOR SECOND GRAPH
var ctx2 = document.getElementById("lessonChart").getContext("2d");
 var dataMap = {
    <?php  foreach ($graph_array as $gkey => $gvalue) {  ?>
         
'<?php echo $gkey; ?>': {
            method: 'Bar',
                data: {
                     labels: [
                            <?php
                            foreach ($gvalue as $quizkey => $quizvalue) {
                                if($quizvalue['given'] == 1){
                                   echo '"'.$quizvalue['title'].'",';
                                }
                            }
                            ?>],
                     datasets: [{
                            label: 'Marks Scored',
                            data: [
                            <?php 

                            if(get_current_user_id() == 2){
                            for ($i=0; $i < 15 ; $i++) { 
                                 echo '"'.$demo_data[$i].'",';
                            }    
                        }else{
                            foreach ($gvalue as $quizkey => $quizvalue) {                                 
                                if($quizvalue['given'] == 1){
                                    echo '"'.$quizvalue['percentage'].'",';
                                }
                            } 
                        }
                            ?>],      
                     backgroundColor: [
                            <?php
                            if(get_current_user_id() == 2){
                            for ($i=0; $i < 15 ; $i++) { 
                                 if ($demo_data[$i] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($demo_data[$i] < 75 && $demo_data[$i] >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($demo_data[$i] <50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                            }
                        }else{

                            foreach ($gvalue as $quizkey => $quizvalue) {
                                if($quizvalue['given'] == 1){
                                    if ($quizvalue['percentage'] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($cvalue['percentage'] < 75 && $quizvalue['percentage'] >= 50){ echo "'rgba(255, 206, 0, 0.8',"; }elseif($quizvalue['percentage'] < 50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                                }
                            }
                        } 
                             ?>],
                     borderColor: [
                            <?php
                            if(get_current_user_id() == 2){
             for ($i=0; $i < 15 ; $i++) { 
               echo "'rgba( 0, 0, 0, 1)',";
            }
        }else{
                            foreach ($gvalue as $quizkey => $quizvalue) {
                                if($quizvalue['given'] == 1){
                                    if ($quizvalue['percentage'] >= 75) { echo "'rgba( 0, 0, 0, 1)',"; }elseif($cvalue['percentage'] < 75 && $quizvalue['percentage'] >= 50){ echo "'rgba( 0, 0, 0, 1)',"; }elseif($quizvalue['percentage'] < 50){ echo "'rgba( 0, 0, 0, 1)',"; }
                                }
                            }
                        }
                             ?>],
                            borderWidth: 1
                     }]
                }           
             },            
<?php 
    }  ?>
};


var currentChart;
function updateChart() {
     if(currentChart){currentChart.destroy();}
     var determineChart = jQuery("#TestCat").val();
     var params = dataMap[determineChart]
     currentChart = new Chart(ctx2,{
        type: 'bar',
        data: params.data,
        options: options2
    }); 
}
jQuery('#TestCat').on('change', updateChart)
updateChart();

</script>
<script>
//FOR THIRD GRAPH
var ctx3 = document.getElementById("testChart").getContext("2d");
 var dataMap2 = {
'all': {
            method: 'Bar',
                data: {
                     labels: [
                            <?php
                                foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                        if(in_array($gkey, $my_query1->posts)){
                                            foreach ($my_query1->posts as $value) {
                                                if($value == $gkey){
                                                    //TEST GIVEN
                                                    $title = get_the_title($gkey);
                                                    $title2 = explode(' ',$title);
                                                    $title_to_display = substr($title2[0], 0, 3).' '.$title2[1];
                                                    echo '"'.$title_to_display.'",';
                                                }elseif($value != $gkey && in_array($gkey, $my_query1->posts)){
                                                    //NOT GIVEN
                                                    $title = get_the_title($value);
                                                    $title2 = explode(' ',$title);
                                                    $title_to_display = substr($title2[0], 0, 3).' '.$title2[1];
                                                    echo '"'.$title_to_display.'",';
                                                }
                                            }
                                            break;
                                        }
                                }
                            ?>],
                     datasets: [{
                            label: 'Marks Scored',
                            data: [
                            <?php
                             if(get_current_user_id() == 2){   
                            for ($i=0; $i < 20 ; $i++) { 
                                 echo '"'.$demo_data[$i].'",';
                            }
                        }else{

                                foreach ($my_query1->posts as $value){
                                    $total_average_score = 0;
                                    if(array_key_exists($value,$test_quiz_cat_result)){
                                        if(array_search($value, array_column($rev_quiz_results, 'quiz')) !== false){
                                            foreach($rev_quiz_results as $key => $revvalue){
                                                if($revvalue['quiz'] == $value){
                                                    $score = $revvalue['percentage'];
                                                    echo '"'.$score.'",';
                                                    break;
                                                }
                                            }
                                        }
                                        }else{
                                            echo '"0",';
                                        }
                                }
                            }
                             ?>],      
                     backgroundColor: [
                            <?php
                            if(get_current_user_id() == 2){
                            for ($i=0; $i < 20 ; $i++) { 
                             if ($demo_data[$i] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($demo_data[$i] < 75 && $demo_data[$i] >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($demo_data[$i] <50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                        }
                    }else{

                                foreach ($my_query1->posts as $value){
                                    $total_average_score = 0;
                                    if(array_key_exists($value,$test_quiz_cat_result)){
                                        if(array_search($value, array_column($rev_quiz_results, 'quiz')) !== false){
                                            foreach($rev_quiz_results as $key => $revvalue){
                                                if($revvalue['quiz'] == $value){
                                                    $score = $revvalue['percentage'];
                                                    if ($score >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($score< 75 && $score >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($score < 50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                                                    break;
                                                }
                                            }
                                        }
                                        }else{
                                            echo "'rgba(255, 0, 0, 0.8)',";
                                        }
                                }
                            }
                             ?>],
                     borderColor: [
                            <?php
                            if(get_current_user_id() == 2){
                             for ($i=0; $i < 20 ; $i++) { 
                               echo "'rgba( 0, 0, 0, 1)',";
                            }
                        }else{      

                                foreach ($my_query1->posts as $value){
                                    $total_average_score = 0;
                                    if(array_key_exists($value,$test_quiz_cat_result)){
                                        if(array_search($value, array_column($rev_quiz_results, 'quiz')) !== false){
                                            foreach($rev_quiz_results as $key => $revvalue){
                                                if($revvalue['quiz'] == $value){
                                                    $score = $revvalue['percentage'];
                                                    if ($score >= 75) { echo "'rgba( 0, 0, 0, 1)',"; }elseif($score< 75 && $score >= 50){ echo "'rgba( 0, 0, 0, 1)',"; }elseif($score < 50){ echo "'rgba( 0, 0, 0, 1)',"; }
                                                    break;
                                                }
                                            }
                                        }
                                        }else{
                                            echo "'rgba(255, 0, 0, 1)',";
                                        }
                                }
                            }
                             ?>],
                            borderWidth: 1
                     }]
                }           
             },

    <?php foreach ($question_category as $catvalue) { ?>     
'<?php echo $catvalue->category_id; ?>': {
            method: 'Bar',
                data: {
                     labels: [
                            <?php
                                foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                        if(in_array($gkey, $my_query1->posts)){
                                            foreach ($my_query1->posts as $value) {
                                                if($value == $gkey){
                                                    //TEST GIVEN
                                                    $title = get_the_title($gkey);
                                                    $title2 = explode(' ',$title);
                                                    $title_to_display = substr($title2[0], 0, 3).' '.$title2[1];
                                                    echo '"'.$title_to_display.'",';
                                                }elseif($value != $gkey && in_array($gkey, $my_query1->posts)){
                                                    //NOT GIVEN
                                                    $title = get_the_title($value);
                                                    $title2 = explode(' ',$title);
                                                    $title_to_display = substr($title2[0], 0, 3).' '.$title2[1];
                                                    echo '"'.$title_to_display.'",';
                                                }
                                            }
                                            break;
                                        }
                                }
                            ?>],
                     datasets: [{
                            label: 'Marks Scored',
                            data: [
                            <?php
                            if(get_current_user_id() == 2){
                            for ($i=0; $i < 20 ; $i++) { 
                                 echo '"'.$demo_data1[$i].'",';
                            }
                        }else{
                            foreach ($my_query1->posts as $quiz_value) {
                                foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                    if($quiz_value == $gkey){
                                        foreach ($gvalue as $quizkey => $quizvalue) {
                                            $catID = $quizvalue['catID'];
                                            if($catvalue->category_id == $catID){
                                                echo '"'.$quizvalue['perScore'].'",';
                                            }elseif(array_search($catID, array_column($gvalue, 'catID')) == false){
                                                echo '"0",';
                                            }
                                        }
                                    }
                                }
                            }
                                // foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                //     if(in_array($gkey, $my_query1->posts)){
                                //         foreach ($gvalue as $quizkey => $quizvalue) {
                                //             $catID = $quizvalue['catID'];
                                //             if($catvalue->category_id == $catID){
                                //                 echo '"'.$quizvalue['perScore'].'",';
                                //             }
                                //         }
                                //     }
                                // }
                            }
                             ?>],      
                     backgroundColor: [
                            <?php
                            if(get_current_user_id() == 2){
                            for ($i=0; $i < 20 ; $i++) { 
                                 if ($demo_data1[$i] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($demo_data1[$i] < 75 && $demo_data1[$i] >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($demo_data1[$i] <50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                            }
                        }else{
                            foreach ($my_query1->posts as $quiz_value) {
                                foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                    if($quiz_value == $gkey){
                                        foreach ($gvalue as $quizkey => $quizvalue) {
                                            $catID = $quizvalue['catID'];
                                            if($catvalue->category_id == $catID){
                                                if ($quizvalue['perScore'] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($cvalue['perScore'] < 75 && $quizvalue['perScore'] >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($quizvalue['perScore'] < 50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                                            }elseif(array_search($catID, array_column($gvalue, 'catID')) == false){
                                                 echo "'rgba(255, 0, 0, 0.8)',";
                                            }
                                        }
                                    }
                                }
                            }

                                // foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                //     if(in_array($gkey, $my_query1->posts)){
                                //         foreach ($gvalue as $quizkey => $quizvalue) {
                                //             $catID = $quizvalue['catID'];
                                //             if($catvalue->category_id == $catID){
                                //                 if ($quizvalue['perScore'] >= 75) { echo "'rgba(88, 219, 0, 0.8)',"; }elseif($cvalue['perScore'] < 75 && $quizvalue['perScore'] >= 50){ echo "'rgba(255, 206, 0, 0.8)',"; }elseif($quizvalue['perScore'] < 50){ echo "'rgba(255, 0, 0, 0.8)',"; }
                                //             }
                                //         }
                                //     }
                                // }
                            }
                             ?>],
                     borderColor: [
                            <?php
                            if(get_current_user_id() == 2){
                                 for ($i=0; $i < 20 ; $i++) { 
                                   echo "'rgba( 0, 0, 0, 1)',";
                                }
                            }else{
                                foreach ($my_query1->posts as $quiz_value) {
                                foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                    if($quiz_value == $gkey){
                                        foreach ($gvalue as $quizkey => $quizvalue) {
                                            $catID = $quizvalue['catID'];
                                            if($catvalue->category_id == $catID){
                                                if ($quizvalue['perScore'] >= 75) { echo "'rgba(0, 0, 0, 1)',"; }elseif($cvalue['perScore'] < 75 && $quizvalue['perScore'] >= 50){ echo "'rgba(0, 0, 0, 1)',"; }elseif($quizvalue['perScore'] < 50){ echo "'rgba(0, 0, 0, 1)',"; }
                                            }elseif(array_search($catID, array_column($gvalue, 'catID')) == false){
                                                 echo "'rgba(0, 0, 0, 1)',";
                                            }
                                        }
                                    }
                                }
                            }

                                // foreach ($test_quiz_cat_result as $gkey => $gvalue) {
                                //     if(in_array($gkey, $my_query1->posts)){
                                //         foreach ($gvalue as $quizkey => $quizvalue) {
                                //             $catID = $quizvalue['catID'];
                                //             if($catvalue->category_id == $catID){
                                //                 if ($quizvalue['perScore'] >= 75) { echo "'rgba( 0, 0, 0, 1)',"; }elseif($cvalue['perScore'] < 75 && $quizvalue['perScore'] >= 50){ echo "'rgba( 0, 0, 0, 1)',"; }elseif($quizvalue['perScore'] < 50){ echo "'rgba( 0, 0, 0, 1)',"; }
                                //             }
                                //         }
                                //     }
                                // }
                            }
                             ?>],
                            borderWidth: 1
                     }]
                }           
             },           
<?php 
    }  ?>
};

var currentChart1;
function updateChart1() {
     if(currentChart1){currentChart1.destroy(); }
     var determineChart1 = jQuery("#selectTest").val();
     var params = dataMap2[determineChart1]
     currentChart1 = new Chart(ctx3,{
    type: 'bar',
    data: params.data,
    options: options2
}); 
}
jQuery('#selectTest').on('change', updateChart1)
updateChart1();
</script>