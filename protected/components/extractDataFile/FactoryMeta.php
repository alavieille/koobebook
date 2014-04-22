<?php 


class FactoryMeta {


	public static function initialize($path,$type){
		switch ($type) {
			case 'application/epub+zip':
				return new EpubMeta($path);
				break;

			case 'application/x-mobipocket-ebook':
				return new MobiMeta($path);
				break;
			
			case 'application/pdf':
				return new PdfMeta($path);
				break;
			
			default:
				throw new Exception("Type de fichier inconnue", 1);
				
				break;
		}
	}
}