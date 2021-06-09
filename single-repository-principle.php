<?php
	// SINGLE CLASS TO SET THE LENGTH OF SQUARE
	class Square
	{
	    public $length;

	    public function __construct($length)
	    {
	        $this->length = $length;
	    }
	}
	// SINGLE CLASS TO SET THE RADIUS OF CIRCLE
	class Circle
	{
	    public $radius;

	    public function __construct($radius)
	    {
	        $this->radius = $radius;
	    }
	}
	// CALCULATE THE AREA OF CIRCLE AND CIRCLE
	class AreaCalculator
	{
	    protected $shapes;

	    public function __construct($shapes = [])
	    {
	        $this->shapes = $shapes;
	    }

	    public function sum()
	    {
	        foreach ($this->shapes as $shape) {
	            if (is_a($shape, 'Square')) {
	                $area[] = pow($shape->length, 2);
	            } elseif (is_a($shape, 'Circle')) {
	                $area[] = pi() * pow($shape->radius, 2);
	            }
	        }

	        return array_sum($area);
	    }

	    public function output()
	    {
	        return implode('', [
	          '',
	              'Sum of the areas of provided shapes: ',
	              $this->sum(),
	          '',
	      ]);
	    }
	}
	// DESIGN THE OUT PUT OF THE RESULTING DATA
	class SumCalculatorOutputter
	{
	    protected $calculator;

	    public function __construct(AreaCalculator $calculator)
	    {
	        $this->calculator = $calculator;
	    }

	    public function JSON()
	    {
	        $data = [
	          'sum' => $this->calculator->sum(),
	      	];

	        return json_encode($data);
	    }

	    public function HTML()
	    {
	        return implode('', [
	          '',
	              'Sum of the areas of provided shapes: ',
	              $this->calculator->sum(),
	          '',
	      ]);
	    }
	}
	
	$shapes = [
		  new Circle(2),
		  new Square(5),
		  new Square(6),
		];
	// echo "<pre>";print_r($shapes);die();
	$areas = new AreaCalculator($shapes);
	// echo "<pre>";print_r($areas->sum());die();
	$output = new SumCalculatorOutputter($areas);

	echo $output->JSON();
	echo "<br>";
	echo $output->HTML();

?>