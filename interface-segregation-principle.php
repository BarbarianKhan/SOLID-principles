<?php
	// SINGLE CLASS TO SET THE LENGTH OF SQUARE
	class Square implements ShapeInterface,ManageShapeInterface
	{
	    public $length;

	    public function __construct($length)
	    {
	        $this->length = $length;
	    }
	    public function area()
	    {
	        return pow($this->length, 2);
	    }
	    public function calculate()
	    {
	        return $this->area();
	    }
	}
	// SINGLE CLASS TO SET THE RADIUS OF CIRCLE
	class Circle implements ShapeInterface,ManageShapeInterface
	{
	    public $radius;

	    public function __construct($radius)
	    {
	        $this->radius = $radius;
	    }
	    public function area()
	    {
	        return pi() * pow($this->radius, 2);
	    }
	    public function calculate()
	    {
	        return $this->area();
	    }
	}
	class Cuboid implements ShapeInterface, ThreeDimensionalShapeInterface, ManageShapeInterface
	{
		public $radius;

	    public function __construct($radius)
	    {
	        $this->radius = $radius;
	    }

	    public function area()
	    {
	    	return pi() * pow($this->radius, 2) * 2;
	        // calculate the surface area of the cuboid
	    }

	    public function volume()
	    {
	    	return pi() * pow($this->radius, 2) * 3;
	        // calculate the volume of the cuboid
	    }
	    public function calculate()
	    {
	    	return $this->area();
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
	        // foreach ($this->shapes as $shape) {
	        //     if (is_a($shape, 'Square')) {
	        //         $area[] = pow($shape->length, 2);
	        //     } elseif (is_a($shape, 'Circle')) {
	        //         $area[] = pi() * pow($shape->radius, 2);
	        //     }
	        // }
	        // return array_sum($area);

	        foreach ($this->shapes as $shape) {
	            // $area[] = $shape->area();
	            if (is_a($shape, 'ShapeInterface')) {
	                $area[] = $shape->area();
	                continue;
	            }

	            throw new AreaCalculatorInvalidShapeException();
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
	class VolumeCalculator extends AreaCalculator
	{
		protected $summedData;
	    public function __construct($shapes = [])
	    {
	        parent::__construct($shapes);
	    }

	    public function sum()
	    {
	        // logic to calculate the volumes and then return an array of output
	       
	    	// echo "<pre>";print_r($this->shapes);die();
	    	foreach ($this->shapes as $shape) {
	            // $area[] = $shape->area();
	            if (is_a($shape, 'ShapeInterface')) {
	                $area[] = $shape->area();
	                continue;
	            }

	            throw new AreaCalculatorInvalidShapeException();
	        }
	        return array_sum($area);
	    	
		}
	}

	class SumCalculatorOutputter {
	    protected $calculator;

	    public function __construct(AreaCalculator $calculator) {
	        $this->calculator = $calculator;
	    }

	    public function JSON() {
	        $data = array(
	            'sum' => $this->calculator->sum()
	        );

	        return json_encode($data);
	    }

	    public function HTML() {
	        return implode('', array(
	            '',
	                'Sum of the areas of provided shapes: ',
	                $this->calculator->sum(),
	            ''
	        ));
	    }
	}


	// INTERFACE TO CALCULATE THE AREA\
	interface ShapeInterface
	{
	    public function area();
	}
	interface ThreeDimensionalShapeInterface
	{
	    public function volume();
	}
	interface ManageShapeInterface
	{
	    public function calculate();
	}
	$shapes = [
		  new Circle(2),
		  new Square(5),
		  new Square(6),
		];
		$singCir = new Circle(12);

	echo "<pre>";print_r($singCir->calculate());die();	
	$areas = new AreaCalculator($shapes);
	$volumes = new VolumeCalculator($shapes);
	echo "<pre>";print_r($volumes->sum());die();
	$output = new SumCalculatorOutputter($areas);
	$output2 = new SumCalculatorOutputter($volumes);

	echo $output->JSON();
	echo "<br>";
	echo $output->HTML();
	echo "<br>";
	echo $output2->JSON();
	echo "<br>";
	echo $output2->HTML();
	echo "<br>";
?>