<?php 
namespace Gui\AluraPlay\Traits;

trait FlashMessageTrait{
    private function addErrorMessage(string $errorMessage): void
    {
        $_SESSION['error_message'] = $errorMessage;
    }
}


?>