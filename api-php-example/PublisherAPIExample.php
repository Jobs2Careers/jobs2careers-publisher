<?php
/**
 * Copyright 2014, Jobs2Careers. All Rights Reserved.
 *
 * @author     Jobs2Careers
 */

// keyword setting
if(isset($_GET["q"])) $kw = $_GET["q"];
else $kw = "customer service";
// locations
if(isset($_GET["l"])) $location = $_GET["l"];
else $location = "";

// generate API url
$rel_job_url = "http://api.jobs2careers.com/api/search.php?id=[YOUR_ID]&pass=[YOUR_API_KEY]&limit=10&hl=b&format=xml&ip=".$_SERVER["REMOTE_ADDR"]."&q=".urlencode($kw)."&l=".$location;
$rs_rel_job = simplexml_load_file($rel_job_url);

// generate HTML code
$job_content = '<div class="j2c_job_content">';
if( $rs_rel_job !== FALSE) {
    if( $rs_rel_job['count'] != 0) {
        foreach ($rs_rel_job as $job) {
            $job_content .= "<div class='job_content_title'><a href='javascript:void(0)' onclick='{$job->onclick}'>{$job->title}</a></div>";
            $job_content .= "<div><i>{$job->company}</i> - <i><span class='job_content_loc'>{$job->city[0]}</span></i></div>";
            $job_content .= "<div>";
            $job_content .= substr(strip_tags($job->description), 0, 150);
            $job_content .= "...</div><br>";
        }
    } else $job_content .= "The search did not match any jobs<br><br>Search suggestions:<ul><li>Try more general keywords</li><li>Check your spelling</li><li>Replace abbreviations with the entire word</li></ul>";
    $job_content .= '<hr /><br><div style="float:left;font-size:10px;">Jobs by <a href="http://www.jobs2careers.com" target="_blank" title="Job Search"><img src="http://www.jobs2careers.com/logo_simple.png" width="80" style="vertical-align:middle" alt="job search"/></a></div><br><hr />';
    $job_content .= '</div>';
}
?>
<script type="text/javascript" src="http://api.Jobs2Careers.com/api/j2c.js"></script>