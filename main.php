<?php

include "./config.php";

function wake($url) {
    $handle = curl_init();
    $identifier = rand();

    curl_setopt_array($handle, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => json_encode([
            "identifier" => $identifier
        ]),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ]);

    $result = curl_exec($handle);

    curl_close($handle);

    if ($result !== strval($identifier)) {
        return false;
    }

    return true;
}

foreach ($urls as $url) {
    $url .= "wake";
    $tryCount = 0;

    echo("Waking: " . $url);

    while (!wake($url)) {
        ++$tryCount;
        
        if ($tryCount > 8) {
            try {
                mail("contact@terrytm.com", "Wake Failure", "Wake Failed: " . $url);
            } catch (Exception $exception) { }

            break;
        }

        echo("\nRetrying...");

        sleep(5);
    }

    echo("\nWake Sucessful!\n");
}

echo(">> Job Complete <<");

?>