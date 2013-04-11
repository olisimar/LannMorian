<?php
	namespace System\Exceptions;
	
	
	class BaseException extends \Exception {
		
		private static $counter = 0;
		
		public function __construct($mess, $code=0, $previous=null) {
			parent::__construct($mess, $code, $previous);
		}
		
		public function getTraceAsHtml() {
			$exp = $this;
			$toReturn  = '<table style="border:3px groove #333;">';
			$toReturn .= '<thead> 
											<th style="border:1px outset #999;">Ord</th>
											<th style="border:1px outset #999;">Type</th>
											<th style="border:1px outset #999;">Code</th>
											<th style="border:1px outset #999;">Message</th>
											<th style="border:1px outset #999;">Line</th>
											<th style="border:1px outset #999;">File</th>
										</thead>';
			$toReturn .= $this->generateLog($exp);
			$toReturn .= '</table>';
			return $toReturn;
		}
		
		private function generateLog(\Exception $e) {
			$toReturn = "";
			$order = array();
			$order = $this->generateSingleExceptionLine($e, $order);
			foreach($order AS $count => $row) {
				$toReturn .= '<tr style="border:1px solid #666;">';
				$toReturn .= '<td style="border:1px solid #999;"> #'. (1+$count) .'</td>';
				$toReturn .= $row;
				$toReturn .= '</tr>';
			}
			return $toReturn;
		}
		
		private function generateSingleExceptionLine(\Exception $e, $order) {
			if($e->getPrevious() != null) {
				$order = $this->generateSingleExceptionLine($e->getPrevious(), $order);
			}
			$type = get_class($e);
			$type = str_replace("System\\Exceptions\\", "", $type);
			$file = str_replace(BASE_DIR, "", $e->getFile());
			$toReturn = '<td style="border:1px solid #999;">'. $type .'</td>';
			$toReturn .= '<td style="border:1px solid #999;text-align:center;">'. $e->getCode() .'</td>';
			$toReturn .= '<td style="border:1px solid #999;">'. $e->getMessage() .'</td>';
			$toReturn .= '<td style="border:1px solid #999;text-align:right;">'. $e->getLine() .'</td>';
			$toReturn .= '<td style="border:1px solid #999;">'. $file .'</td>';
			$order[] = $toReturn;
			return $order;
		}
	}
?>