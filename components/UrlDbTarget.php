<?php 

namespace app\components;

use yii\log\DbTarget;

class UrlDbTarget extends DbTarget
{
    // Override as a static method to match the parent's signature.
    public function export()
    {
        $filteredMessages = [];
        foreach ($this->messages as $message) {
            // Only process messages with the "url" category
            if (isset($message[2]) && $message[2] === 'url') {
                $logMsg = is_array($message[0]) ? implode(' ', $message[0]) : $message[0];
                // Extract URL by removing the "Test URL:" prefix if present
                $url = trim(str_replace('Test URL:', '', $logMsg));
                // Skip messages if URL ends with a common file extension
                if (!preg_match('/\.(png|jpe?g|gif|js|css|map|pdf)$/i', $url)) {
                    $filteredMessages[] = $message;
                }
            }
        }
        $this->messages = $filteredMessages;
        parent::export();
    }
}
