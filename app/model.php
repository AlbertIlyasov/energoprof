<?

abstract class Model
{
	public $date;


	public function whoAmI()
	{
		echo get_parent_class();
		return $this;
	}
}