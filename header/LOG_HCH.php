<?php
class HCH_Log
{
    var $logfile; // 로그 파일 네임. (ex) 웨이팅 기능 파일들의 이 로그 파일에 담긴다.)
    var $log_dir = "/var/www/html/debug/log/logs";
    var $dir_log_filename; // 경로까지 합쳐진 파일명.

    var $current_file_name; // 현재 로그를 찍고 있는 파일명.
    var $user_IP;

    const db_error_log_dir = "/var/log/mysql/mysqlErr.log";
    const db_general_log_dir = "/var/lib/mysql/teamnova-68705.log";

    function __construct($log_file_name, $current_file_name, $current_file_explain, $user_IP)

    {
        $this->logfile = $log_file_name; // logfile에는 기능을 입력해준다. ex) 웨이팅 신청 같은 경우는 waiting_apply
        $this->dir_log_filename = $this->log_dir ."/". $this->logfile;
        $this->dir_log_filename .= ".log";

        $this->current_file_name = $current_file_name; // (로그찍고 있는) 현재 파일 이름 저장
        $this->user_IP = $user_IP; // 사용자 IP 저장


        $fh = fopen($this->dir_log_filename, "a");

        fwrite($fh, "================================================================". "\n");
        fwrite($fh, "◇ 현재 파일명 : ".$current_file_name. "\n");
        fwrite($fh, "◇ 현재 파일 기능 설명 : ".$current_file_explain. "\n");
        fwrite($fh, "◇ 현재 시간 : "."[".date("y.m.d G:i:s"). "]". "\n");
        fwrite($fh, "◇ 현재 사용자 IP : ".$user_IP. "\n\n");

        fclose($fh);
    }


    function write($txt)
    {

        $fh = fopen($this->dir_log_filename, "a");
        if (is_array($txt)) {
            //$txt = "::::::::".$txt;
            $ar = $txt;
            $txt = "Array:::::\n";
            foreach ($ar as $key => $value) {
                $txt += $key . "=" . $value . "\n";
            }
        }

        fwrite($fh, $txt . "\n");
        fclose($fh);
    }

    function info($log_explain, $log_vars)
    {
        $fh = fopen($this->dir_log_filename, "a");

        fwrite($fh, "----------------------------------------------------------------" . "\n");
        fwrite($fh, "【정보 로그】 : ". "\n\n");
        fwrite($fh, "『로그 설명』 : ".$log_explain. "\n");
        fwrite($fh, "『로그 변수들』 : {"."\n");
        if (is_array($log_vars)) {
            $process_log_vars = null;
            foreach ($log_vars as $key => $value) {
                $process_log_vars .= "\t".$key . " = " . $value . "\n";
            }
            fwrite($fh, $process_log_vars."}"."\n");
        }
        fwrite($fh, "----------------------------------------------------------------" . "\n\n");

        fclose($fh);
    }

    function error($error_cause, $error_solution, $log_vars)
    {
        $fh = fopen($this->dir_log_filename, "a");

        fwrite($fh, "----------------------------------------------------------------" . "\n");
        fwrite($fh, "※※※※ 에러 로그 ※※※※". "\n\n");
        fwrite($fh, "『에러 원인』 : ".$error_cause. "\n");
        fwrite($fh, "『에러 해결책』 : ".$error_solution. "\n");
        fwrite($fh, "『에러 관련 변수들』 : {"."\n");
        if (is_array($log_vars)) {
            $process_log_vars = null;
            foreach ($log_vars as $key => $value) {
                $process_log_vars .= "\t".$key . " = " . $value . "\n";
            }
            fwrite($fh, $process_log_vars."}"."\n");
        }
        fwrite($fh, "----------------------------------------------------------------" . "\n\n");


        fclose($fh);
    }
}

?>