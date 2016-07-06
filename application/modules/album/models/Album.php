<?php

class Album_Model_Album
{
    protected $_id;
    protected $_artist;
    protected $_title;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Album property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Album property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function setArtist($artist)
    {
    	$this->_artist = (string) $artist;
    	return $this;
    }
    
    public function getArtist()
    {
    	return $this->_artist;
    }
    
    public function setTitle($title)
    {
    	$this->_title = (string) $title;
    	return $this;
    }
    
    public function getTitle()
    {
    	return $this->_title;
    }
    
    public function populate($row)
    {
    	if (is_array($row)) {
    		$row = new ArrayObject($row, ArrayObject::ARRAY_AS_PROPS);
    	}
    	if (isset ($row->id)) {
    		$this->setId($row->id);
    	}
    	if (isset ($row->artist)) {
    		$this->setArtist($row->artist);
    	}
    	if (isset ($row->title)) {
    		$this->setTitle($row->title);
    	}
    }
}

