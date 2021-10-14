<?php 
/**
 * Emp Page Controller
 * @category  Controller
 */
class EmpController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "emp";
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","title","about","organizer","timestamp","email","address","latitude","longitude","tags");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'title' => 'required',
				'about' => 'required',
				'organizer' => 'required',
				'timestamp' => 'required',
				'email' => 'required|valid_email',
				'address' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'tags' => 'required',
			);
			$this->sanitize_array = array(
				'title' => 'sanitize_string',
				'about' => 'sanitize_string',
				'organizer' => 'sanitize_string',
				'timestamp' => 'sanitize_string',
				'email' => 'sanitize_string',
				'address' => 'sanitize_string',
				'latitude' => 'sanitize_string',
				'longitude' => 'sanitize_string',
				'tags' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("emp.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
}
