<?php
class BaseController
{
    const VIEW_FOLDER = './app/views';
    const MODEL_FOLDER = './app/models';
    
    /*  
        ?path: folderName.fileName
        !path in 'views' folder
    */
    protected function view($viewPath, array $params = [])
    {

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        $newViewPath = self::VIEW_FOLDER . "/" . str_replace('.', '/', $viewPath) . '.php';
        require $newViewPath;
    }

    /*      
        ?modelPath: folderName.fileName
        !path in 'models' folder
    */
    protected function loadModel($modelPath)
    {
        $newModelPath = self::MODEL_FOLDER . "/" . $modelPath . '.php';
        require $newModelPath;
    }
}
?>