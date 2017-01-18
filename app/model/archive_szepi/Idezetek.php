<?php
namespace Szepi\Model;

use Szepi\Core\Model;

class Idezetek extends Model
{
    public $db;
    public $id_quote;
    public $tpl;
    
    public function __construct($id_quote)
    {
        parent::__construct();
        
        $this->id_quote = $id_quote;
        
        $this->logPageview('i', $this->id_quote );
    }
    
    public function tplTitle()
    {
        $quote_array = $this->quotesById($this->id_quote);
        $quote_array = $quote_array[0];//get the first row
        $this->tpl['title'] = $quote_array['szoveg'].' - '.$quote_array['szerzo'];
        
        return $this->tpl['title'];
    }

    public function tplDesc()
    {   //description is same as title now
        $this->tpl['desc'] = $this->tplTitle($this->id_quote);
        return $this->tplTitle($this->id_quote);
    }

    public function tplQuote()
    {
        $sql = "SELECT * FROM idezetek WHERE id='".$this->id_quote."'";
        $this->tpl['quote'] = $this->db->query($sql)[0];//first item
        return $this->tpl['quote'];
    }
    
    public function tplSelected()
    {
        $this->tpl['selected']['id_type']  = $this->tpl['quote']['t1'];
        $this->tpl['selected']['id_cat']   = $this->tpl['quote']['k1'];
    }
    public function tplList()
    {
        $this->tpl['list'] = $this->quotesById($this->id_quote);

    }

}
?>