<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WhatsApp {
    public function send_message($phone, $code) {
        $command = escapeshellcmd("node " . APPPATH . "public/bot.js $phone $code");
        shell_exec($command);
    }
}
?>
