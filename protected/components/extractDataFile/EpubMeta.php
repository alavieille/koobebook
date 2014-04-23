<?php 
/**
* Class who extract metadata of an epub
**/
class EpubMeta extends AbstractMeta
{

	protected $pathFile;
	protected $zipFile;
	protected $opfFile;

	public function __construct($pathFile)
	{
		$this->pathFile = $pathFile;
		$this->opfFile = $this->getOpfFile($this->getPathOpfFile());
	}

	public function getPathOpfFile()
	{
		$this->zipFile = new ZipArchive();
		$this->zipFile->open($this->pathFile);
		$container = simplexml_load_string($this->zipFile->getFromName('META-INF/container.xml'));	
		return $container->rootfiles->rootfile['full-path'];
	
		//var_dump($this->zipFile);
	}

	private function getOpfFile($pathOpfFile)
	{
		return simplexml_load_string($this->zipFile->getFromName($pathOpfFile));
	}

	public function getTitle()
	{
		return (string) $this->opfFile->metadata->children("dc",true)->title;
	}

	public function getAuthor()
	{
		return $this->getRole("aut");
	}
	public function getLanguage()
	{
		
		return (string) $this->opfFile->metadata->children("dc",true)->language;
	}

	public function getDescription()
	{
		
		return (string) $this->opfFile->metadata->children("dc",true)->description;
	}

	public function getDate()
	{
		return (string) $this->opfFile->metadata->children("dc",true)->date;
	}


	public function getRole($role)
	{
		$arrayRole = array();
		foreach ($this->opfFile->metadata->xpath("*[@opf:role='".$role."']") as $value) {
			$arrayRole[] = (string) $value;
		}
		return $arrayRole;
	}



	public function getIsbn()
	{
		$isbn = $this->opfFile->metadata->xpath("dc:identifier[@opf:scheme='ISBN']");
		if(count($isbn) > 0 ) {
			return (string) $isbn[0];
		}
		return null;
	}

}
