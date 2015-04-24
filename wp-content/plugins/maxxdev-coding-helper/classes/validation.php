<?php

class Maxxdev_Helper_Form_Validation {

	private $fieldTypeMinMax = "minmax";
	private $fieldTypeEquals = "equals";
	private $fieldTypeMinMaxLength = "minmaxlength";

	/**
	 * What´s the result of the validation?
	 *
	 * @var boolean
	 */
	private $validation_result = true;

	/**
	 * All fields to check
	 *
	 * @var Maxxdev_Helper_Form_Validation_Field
	 */
	private $fields = array();

	/**
	 * All error messages that has been occured at checking all fields
	 *
	 * @var string
	 */
	private $error_messages = array();

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Adds a new field to the validation
	 *
	 * @param string $value
	 * @param string $fieldname
	 * @param boolean $required
	 * @param int $minlength
	 * @param int $maxlength
	 * @param string $regex
	 */
	private function addField($type, $value, $fieldname, $required, $minlength, $maxlength, $regex, $value2 = null, $fieldname2 = null) {
		$this->fields[] = new Maxxdev_Helper_Form_Validation_Field($type, $value, $fieldname, $required, $minlength, $maxlength, $regex, $value2, $fieldname2);
	}

	/**
	 * Adds an errormessage to the output
	 *
	 * @param array $string
	 */
	private function addErrorMessage($string) {
		$this->error_messages[] = $string;
	}

	/**
	 * returns all errormessages
	 *
	 * @return array
	 */
	public function getErrorMessages() {
		return $this->error_messages;
	}

	/**
	 * returns all errormessages as a whole output-string
	 *
	 * @param string $prefix the prefix which will be set before every message
	 * @param string $suffix the prefix which will be set after every message
	 * @return string
	 */
	public function getErrorMessagesStr($prefix = "<p>", $suffix = "</p>") {
		$str = "";

		if (count($this->error_messages) > 0) {
			foreach ($this->error_messages as $message) {
				$str .= $prefix . $message . $suffix;
			}
		}

		return $str;
	}

	public function checkIfMailAlreadyExists($email, $user_id) {
		global $wpdb;

		return count($wpdb->get_results("SELECT ID FROM " . $wpdb->prefix . "users WHERE ID != '" . $user_id . "' AND user_email = '" . $email . "'"));
	}

	/**
	 * Validates all fields and returns an array with the result (bool) and a message (string)
	 */
	public function check() {
		$result = true;

		foreach ($this->fields as $field) {
			if ($field->required == true && strlen($field->value) == 0) {
				$result = false;

				// add errormessage
				$this->addErrorMessage(sprintf("Bitte Feld %s ausfüllen", $field->fieldname));
			} else {
				if (strlen($field->value) > 0) {
					if ($field->type == $this->fieldTypeMinMax) {
						if (is_numeric($field->value)) {
							if ($field->value >= $field->minlength && $field->value <= $field->maxlength) {
								// everything´s ok
							} else {
								$result = false;
								$this->addErrorMessage(sprintf("Wert muss zwischen %d und %d liegen", $field->minlength, $field->maxlength));
							}
						} else {
							$result = false;
							$this->addErrorMessage("Wert muss eine Zahl sein");
						}
					} elseif ($field->type == $this->fieldTypeEquals) {
						if ($field->value == $field->value2) {
							// everything´s ok
						} else {
							$result = false;
							$this->addErrorMessage(sprintf("Die Felder \"%s\" und \"%s\" müssen denselben Wert haben", $field->fieldname, $field->fieldname2));
						}
					} elseif ($field->type == $this->fieldTypeMinMaxLength) {
						$length = strlen($field->value);

						if ($field->minlength > 0 && $field->maxlength > 0) {
							if ($length >= $field->minlength && $length <= $field->maxlength) {
								// everything´s ok
							} else {
								$result = false;
								$this->addErrorMessage(sprintf("Das Feld \"%s\" muss mindestens %d und darf maximal %d Zeichen enthalten", $field->fieldname, $field->minlength, $field->maxlength));
							}
						} elseif ($field->minlength > 0) {
							if ($length >= $field->minlength) {
								// everything´s ok
							} else {
								$result = false;
								$this->addErrorMessage(sprintf("Das Feld \"%s\" muss mindestens %d Zeichen enthalten", $field->fieldname, $field->minlength));
							}
						} elseif ($field->maxlength > 0) {
							if ($length <= $field->maxlength) {
								// everything´s ok
							} else {
								$result = false;
								$this->addErrorMessage(sprintf("Das Feld \"%s\" darf maximal %d Zeichen enthalten", $field->fieldname, $field->maxlength));
							}
						}
					} else {
						$preg_result = preg_match($field->regex, $field->value);

						if ($preg_result == 0 || $preg_result == false) {
							$result = false;
							$this->addErrorMessage(sprintf("Bitte Angaben beim Feld \"%s\" prüfen", $field->fieldname));
						}
					}
				} else {
					// value not filled, but field is optional, so don´t check anything
				}
			}
		}

		$this->validation_result = $result;
	}

	/**
	 * returns the result of the validation
	 *
	 * @return boolean
	 */
	public function getResult() {
		return $this->validation_result;
	}

	/**
	 * Adds a name validation
	 *
	 * @param string $value The value of the field
	 * @param string $fieldname The fieldname, for the errormessage
	 * @param bool $required Is the field required or not?
	 * @param int $minlength Minlength of the value, default 2
	 * @param int $maxlength Maxlength of the value, default 30
	 */
	public function addName($value, $fieldname, $required = false, $minlength = 2, $maxlength = 30) {
		$regex = "/[A-zäöüß \-]{" . $minlength . "," . $maxlength . "}/i";
		$this->addField("name", $value, $fieldname, $required, $minlength, $maxlength, $regex);
	}

	/**
	 * Adds a street validation
	 *
	 * @param string $value The value of the field
	 * @param string $fieldname The fieldname, for the errormessage
	 * @param bool $required Is the field required or not?
	 * @param int $minlength Minlength of the value, default 2
	 * @param int $maxlength Maxlength of the value, default 30
	 */
	public function addStreet($value, $fieldname, $required = false, $minlength = 2, $maxlength = 30) {
		$regex = "/[A-zäöüß \-]{" . $minlength . "," . $maxlength . "}/i";
		$this->addField("street", $value, $fieldname, $required, $minlength, $maxlength, $regex);
	}

	/**
	 * Adds a street validation
	 *
	 * @param string $value The value of the field
	 * @param string $fieldname The fieldname, for the errormessage
	 * @param bool $required Is the field required or not?
	 * @param int $minlength Minlength of the value, default 2
	 * @param int $maxlength Maxlength of the value, default 30
	 */
	public function addPostcode($value, $fieldname, $required = false, $minlength = 3, $maxlength = 10) {
		$regex = "/[A-z0-9 ]{" . $minlength . "," . $maxlength . "}/i";
		$this->addField("street", $value, $fieldname, $required, $minlength, $maxlength, $regex);
	}

	/**
	 * Adds a street validation
	 *
	 * @param string $value The value of the field
	 * @param string $fieldname The fieldname, for the errormessage
	 * @param bool $required Is the field required or not?
	 * @param int $minlength Minlength of the value, default 2
	 * @param int $maxlength Maxlength of the value, default 30
	 */
	public function addCity($value, $fieldname, $required = false, $minlength = 3, $maxlength = 30) {
		$regex = "/[A-z0-9äöüß \-]{" . $minlength . "," . $maxlength . "}/i";
		$this->addField("street", $value, $fieldname, $required, $minlength, $maxlength, $regex);
	}

	/**
	 * Adds an email validation
	 *
	 * @param string $value The value of the field
	 * @param string $fieldname The fieldname, for the errormessage
	 * @param bool $required Is the field required or not?
	 * @param int $minlength Minlength of the value, default 3
	 * @param int $maxlength Maxlength of the value, default 30
	 */
	public function addEmail($value, $fieldname, $required = false) {
		$min = 2;
		$max = 100;
		$regex = "/[A-Z0-9\.\_\-]{1,100}[@{1}][A-Z0-9\.\-]+\.[A-Z]{2,4}/i";

		$this->addField("email", $value, $fieldname, $required, $min, $max, $regex);
	}

	/**
	 * Adds a min/max-value validation
	 *
	 * @param string $value The value of the field
	 * @param string $fieldname The fieldname, for the errormessage
	 * @param bool $required Is the field required or not?
	 * @param int $min the min value
	 * @param int $max the max value
	 */
	public function addMinMaxValue($value, $fieldname, $required, $min, $max) {
		$regex = "";

		$this->addField($this->fieldTypeMinMax, $value, $fieldname, $required, $min, $max, $regex);
	}

	public function addEqualsToValue($value, $value2, $fieldname1, $fieldname2, $required) {
		$this->addField($this->fieldTypeEquals, $value, $fieldname1, $required, -1, -1, "", $value2, $fieldname2);
	}

	public function addMinMaxLengthValue($value, $fieldname, $required, $minlength, $maxlength) {
		$this->addField($this->fieldTypeMinMaxLength, $value, $fieldname, $required, $minlength, $maxlength, "");
	}

	public function addMinLengthValue($value, $fieldname, $required, $minlength) {
		$this->addField($this->fieldTypeMinMaxLength, $value, $fieldname, $required, $minlength, -1, "");
	}

	public function addMaxLengthValue($value, $fieldname, $required, $maxlength) {
		$this->addField($this->fieldTypeMinMaxLength, $value, $fieldname, $required, -1, $maxlength, "");
	}

}

class Maxxdev_Helper_Form_Validation_Field {

	public $type;
	public $value;
	public $fieldname;
	public $required;
	public $minlength;
	public $maxlength;
	public $regex;
	// optional
	public $value2;
	public $fieldname2;

	public function __construct($type, $value, $fieldname, $required, $minlength, $maxlength, $regex, $value2 = null, $fieldname2 = null) {
		$this->type = $type;
		$this->value = $value;
		$this->fieldname = $fieldname;
		$this->required = $required;
		$this->minlength = $minlength;
		$this->maxlength = $maxlength;
		$this->regex = $regex;

		// optional
		$this->value2 = $value2;
		$this->fieldname2 = $fieldname2;
	}

}
