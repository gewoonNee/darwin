<?php
	
	require_once("Usercart.class.php");
	
	class Shoppingcart_class
	{
		//Fields
		private $items = array();
		
		//Properties
		public function getItems() { return $this->items; }
		
		//Constructor
		public function __constructor()
		{
			
		}
		
		public function addToCart($product, $aantal)
		{
			foreach($this->items as $key => $value)
			{
				if($value['id'] == $product->getId())
				{
					$this->items[$key]['aantal'] += $aantal;
					return;
				}
			}
			
			$this->items[] = array('id' => $product->getId(), 'categorie' => $product->getCategorie(), 'productnaam' => $product->getProductnaam(), 'prijs' => $product->getPrijs(), 'fotonaam' => $product->getFotonaam(), 'beschrijving' => $product->getBeschrijving(), 'aantal' => $aantal);
			
			echo $product->getProductnaam()." is toegevoegd.";
			header('refresh:4;url=index.php?action=startpagina');
			
		}
		
		public function removeFromCart($product, $aantal)
		{
			foreach($this->items as $key => $value)
			{
				if($value['id'] == $product->getId())
				{
					if($value['aantal'] > 1)
					{
						$this->items[$key]['aantal'] -= $aantal;	
						echo $product->getProductnaam." is verwijderd.";
						header('refresh:4;url=index.php?action=startpagina');
						return;
					}
					else
					{
						unset($this->items[$key]);
						echo $product->getProductnaam." is verwijderd.";
						header('refresh:4;url=index.php?action=startpagina');
						return;
					}
				}
			}
		}
		
		public function clearcart()
		{
			$this->items = array();	
		}
		
		public function isEmpty()
		{
			return empty($this->items);	
		}
		
		public function inCart($product)
		{
			foreach($this->items as $key => $value)
			{
				if($value['id'] == $product)
					{
						if($value['aantal'] > 0)
						{
							return true;
						}
						else
						{
							return false;	
						}
					}
			}
		}
		
		public function amountInCart($product)
		{
			foreach($this->items as $key => $value)
			{
				if($value['id'] == $product)
					{
						return $this->items[$key]['aantal'];	
					}
			}
		}
		
		public function totalPrice()
		{
			$totalPrice = 0;
			foreach($this->items as $product)
			{
				$totalPrice += $product['prijs'] * $product['aantal'];
			}
			return $totalPrice;
		}
		
		public function serializeSaveCart()
		{
			$userCart = Usercart_class::find_by_id();
			$serialized = serialize($this->items);
			date_default_timezone_set("Europe/Amsterdam");
			$datum = date("Y-m-d H:i:s");
			if(isset($userCart))
			{
				Usercart_class::updateUsercart($userCart->getUserId(), $serialized, $datum);
			}
			else
			{
				Usercart_class::insertIntoUsercart($serialized, $date);
			}
		}
		
		public function getSavedCart()
		{
			$userCart = Usercart_class::find_by_id();
			if(isset($userCart))
			{
				$tempCart = unserialize($userCart->getCartContent());
				foreach($tempCart as $item)
				{
					$this->items[] = array('id' => $item['id'], 'categorie' => $item['categorie'], 'productnaam' => $item['productnaam'], 'prijs' => $item['prijs'], 'fotonaam' => $item['fotonaam'], 'beschrijving' => $item['beschrijving'], 'aantal' => $item['aantal']);
				}
			}
			
			else
			{
				
			}
		}
	}
?>