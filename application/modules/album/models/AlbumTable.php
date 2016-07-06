<?php

class Album_Model_AlbumTable extends Zend_Db_Table_Abstract
{
	protected $_name = 'album';
	
	public function getAlbum($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
	
	public function saveAlbum(Album_Model_Album $album)
	{
		$data = array(
			'artist' 	=> $album->getArtist(),
			'title' 	=> $album->getTitle()
		);
		
		$id = (int)$album->getId();
	
		if ($id == 0) {
    		try {
				$this->insert($data);
			} catch (Zend_Db_Exception $e) {
				var_dump($e->getMessage());
			}
		} else {
			$this->update($data, array('id = ?' => $id));
		}
	}
	
	public function deleteAlbum($id)
	{
		$this->delete('id =' . (int)$id);
	}
}