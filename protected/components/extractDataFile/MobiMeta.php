<?php 
class palmDOCHeader
{
    public $Compression = 0;
    public $TextLength = 0;
    public $Records = 0;
    public $RecordSize = 0;
}

class palmHeader
{
    public $Records = array();
}

class palmRecord
{
    public $Offset = 0;
    public $Attributes = 0;
    public $Id = 0;
}

class mobiHeader
{
    public $Length = 0;
    public $Type = 0;
    public $Encoding = 0;
    public $Id = 0;
    public $FileVersion = 0;

}

class exthHeader
{
    public $Length = 0;
    public $Records = array();  
}

class exthRecord
{
    public $Type = 0;
    public $Length = 0;
    public $Data = "";
}

class MobiMeta extends AbstractMeta {
    protected $mobiHeader;
    protected $exthHeader;

    public function __construct($file){
        $handle = fopen($file, "r");
        if ($handle){
            fseek($handle, 60, SEEK_SET);
            $content = fread($handle, 8);
            if ($content != "BOOKMOBI"){
                echo "Invalid file format";
                fclose($handle);
                return;
            }


            $palmHeader = new palmHeader();

            fseek($handle, 0, SEEK_SET);
            $name = fread($handle, 32);

            fseek($handle, 76, SEEK_SET);
            $content = fread($handle, 2);
            $records = hexdec(bin2hex($content));
        

            fseek($handle, 78, SEEK_SET);
            for ($i=0; $i<$records; $i++){
                $record = new palmRecord();

                $content = fread($handle, 4);
                $record->Offset = hexdec(bin2hex($content));

                $content = fread($handle, 1);
                $record->Attributes = hexdec(bin2hex($content));

                $content = fread($handle, 3);
                $record->Id = hexdec(bin2hex($content));

                array_push($palmHeader->Records, $record);
             
            }

            // PalmDOC Header
            $palmDOCHeader = new palmDOCHeader();
            fseek($handle, $palmHeader->Records[0]->Offset, SEEK_SET);
            $content = fread($handle, 2);
            $palmDOCHeader->Compression = hexdec(bin2hex($content));
            $content = fread($handle, 2);
            $content = fread($handle, 4);
            $palmDOCHeader->TextLength = hexdec(bin2hex($content));
            $content = fread($handle, 2);
            $palmDOCHeader->Records = hexdec(bin2hex($content));
            $content = fread($handle, 2);
            $palmDOCHeader->RecordSize = hexdec(bin2hex($content));
            $content = fread($handle, 4);

        
            // MOBI Header
            $mobiStart = ftell($handle);
            $content = fread($handle, 4);
            if ($content == "MOBI"){
                $this->mobiHeader = new mobiHeader();
                $content = fread($handle, 4);
                $this->mobiHeader->Length = hexdec(bin2hex($content));

                $content = fread($handle, 4);
                $this->mobiHeader->Type = hexdec(bin2hex($content));

                $content = fread($handle, 4);
                $this->mobiHeader->Encoding = hexdec(bin2hex($content));

                $content = fread($handle, 4);
                $this->mobiHeader->Id = hexdec(bin2hex($content));

             
                fseek($handle, $mobiStart+$this->mobiHeader->Length, SEEK_SET);
                $content = fread($handle, 4);
                if ($content == "EXTH"){
                    $this->exthHeader = new exthHeader();
                   

                    $content = fread($handle, 4);
                    $this->exthHeader->Length = hexdec(bin2hex($content));

                    $content = fread($handle, 4);
                    $records = hexdec(bin2hex($content));
              

                    for ($i=0; $i<$records; $i++){
                        $record = new exthRecord();

                        $content = fread($handle, 4);
                        $record->Type = hexdec(bin2hex($content));

                        $content = fread($handle, 4);
                        $record->Length = hexdec(bin2hex($content));

                        $record->Data = fread($handle, $record->Length - 8);

                        array_push($this->exthHeader->Records, $record);      
                    }
                }
            }

            fclose($handle);
        }
    }

    protected function GetRecord($type)
    {
        foreach ($this->exthHeader->Records as $record){
            if ($record->Type == $type)
                return $record;
        }
        return NULL;
    }

    protected function GetRecordData($type)
    {
        $record = $this->GetRecord($type);
        if ($record)
            return $record->Data;
        return "";
    }

    public function getTitle()
    {
        return $this->GetRecordData(503);
    }

    public function getAuthor()
    {
        return array($this->GetRecordData(100));
    }

    public function getIsbn()
    {
        return $this->GetRecordData(104);
    }

    public function getDescription()
    {
        return $this->GetRecordData(103);
    }

    public function getDate()
    {
        return $this->GetRecordData(106);
    }



}

/*"drm server id" => 1,
        "drm commerce id" => 2,
        "drm ebookbase book id" => 3,
        "author" => 100,
        "publisher" => 101,
        "imprint" => 102,
        "description" => 103,
        "isbn" => 104,
        "subject" => 105,
        "publishingdate" => 106,
        "review" => 107,
        "contributor" => 108,
        "rights" => 109,
        "subjectcode" => 110,
        "type" => 111,
        "source" => 112,
        "asin" => 113,
        "versionnumber" => 114,
        "sample" => 115,
        "startreading" => 116,
        "retail price" => 118,
        "retail price currency" => 119,
        "coveroffset" => 201,
        "thumboffset" => 202,
        "hasfakecover" => 203,
        "Creator Software" => 204,
        "Creator Major Version" => 205,
        "Creator Minor Version" => 206,
        "Creator Build Number" => 207,
        "watermark" => 208,
        "tamper proof keys" => 209,
        "fontsignature" => 300,
        "clippinglimit" => 401,
        "publisherlimit" => 402,
        "403" => 403,
        "ttsflag" => 404,
        "cdetype" => 501,
        "lastupdatetime" => 502,
        "updatedtitle" => 503
*/