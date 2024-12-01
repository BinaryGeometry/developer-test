<?php 
// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Developer Test</title>

//     <link rel="stylesheet" href="./dist/css/style.min.css">

//     <!-- https://fonts.google.com/specimen/Roboto -->
//     <link rel="preconnect" href="https://fonts.googleapis.com">
//     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
//     <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

//     <style>
//         <?php echo file_get_contents('./dist/css/critical.min.css'); ? >
//     </style>
// </head>
// <body>
//     <div class="container">
//     

    clearstatcache();
    $error = '';
    $cacheFilename = 'cache.txt';
    
    if (false === filesize('cache.txt') || time()-filemtime($cacheFilename) > 2 * 3600) {
        $file = fopen($cacheFilename, "w") ;
        // file older than 2 hours
        unlink($cacheFilename);
        $file = fopen($cacheFilename, "w") ;
        
        try {
            $steamDataRaw = file_get_contents('https://api.steampowered.com/ISteamApps/GetAppList/v2/');
            $steamData = json_decode($steamDataRaw, true);
            if(empty($steamData)){
                $error = 'Failed to open stream - steam is down';
            }
        } catch (Exception $e) {
            $error = 'Something went wrong'; 
        }
        file_put_contents($cacheFilename, json_encode($steamData), FILE_APPEND | LOCK_EX);
        echo 'then';
        var_dump($error, $steamData); die;
    } else {
        // file younger than 2 hours
        if( file_exists($cacheFilename)){
            $steamData = file_get_contents($cacheFilename);
            $steamData = json_decode($steamData, true);
        }
    }

    if (0 !== strlen($error)){
        header('Content-Type: application/json; charset=utf-8');
        json_encode(['error'=>$error]);
    } else {
        header('Content-Type: application/json; charset=utf-8');
        $payloadData = sanitzePayload($steamData['applist']['apps']);
        echo json_encode($payloadData);
    }

    function sanitzePayload(array $payload) : array{
        $sanitizedPayload = [];
        foreach ($payload as $app) {
            $id = null;
            $name = null;
            if(is_numeric($app['appid'] )) {
                $id = $app['appid'];
            }
            if( null !== $app['name'] && strlen($app['name']) > 0 ) {
                $name = strip_tags($app['name'] ) ;
            }
            if(null !== $id && null !== $name){
                $entry = [
                    'appid' => $id,
                    'name' => $name
                ];
                $sanitizedPayload[] = $entry;
            }
        }    
        return $sanitizedPayload;
    }

// </div>
// </body>
    ?>