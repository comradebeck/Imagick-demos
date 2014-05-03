<?php


namespace ImagickDemo;


class Example {

    protected $colors;

    protected $imagePath;
    
    function __construct(\ImagickDemo\Colors $colors, $imagePath) {
        \Intahwebz\Functions::load();
        $this->colors = $colors;
        $this->imagePath = $imagePath;
    }
    
    function getParameters() {
        return [];
    }

    function getFilename() {
        $fullClassName = get_class($this);
        //$classPathPart = str_replace('\\', '_', getNamespace($fullClassName));
        $classPathPart = str_replace('\\', '/', getNamespace($fullClassName));
        $params = $this->getParameters();
        $filename = $classPathPart.'/'.getClassName($fullClassName); 
        
        if (!empty($params)) {
            $filename .= '_'.md5(json_encode($params));
        }

        return $filename;
    }

    function renderTitle() {
        
        return getClassName(get_class($this));
    }
    
    function renderImageURL() {
        echo "An image url would go here.";
    }
    
    function renderImage() {
        //TODO - show not implemented image.
        return "Image goes here?";
    }
    
    function renderImageSafe() {
        try {
            /** @noinspection PhpVoidFunctionResultUsedInspection */
            $this->renderImage();
        }
        catch(\Exception $e) {
            $draw = new \ImagickDraw();

            $strokeColor = new \ImagickPixel('none');
            $lightColor = new \ImagickPixel('brown');

            $draw->setStrokeColor($strokeColor);
            $draw->setFillColor($lightColor);

            $draw->setStrokeWidth(1);

            $draw->setFontSize(24);
            $draw->setFont("../fonts/Arial.ttf");

            $draw->setTextAntialias(false);
            $draw->annotation(50, 75, $e->getMessage());

            $imagick = new \Imagick();
            $imagick->newImage(500, 250, "SteelBlue2");
            $imagick->setImageFormat("png");
            $imagick->drawImage($draw);

            //$imagick->scaleimage(2000, 1000);
//Send the image to the browser
            header("Content-Type: image/png");
            echo $imagick->getImageBlob();
        }
        
        return null;
    }
    
    function renderDescription() {
        //return "Choose something mofo.";
        return "";
    }
    
}

 