<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller
{

    public function __construct()
    {
		parent::__construct();
		
		$this->load->helper(['form', 'url']);
		$this->load->library(['form_validation', 'session']);
		$this->load->model('record_model');
    }

    public function list()
	{
		$data['title'] = 'Records';
		$data['fdata'] = $this->session->flashdata('fdata');

		if (isset($data['fdata']['search_results']))
		{
			$data['records'] = $data['fdata']['search_results'];
		}
		else
		{
			$response = $this->record_model->getAll();

			if (isset($response['error']))
			{
				if (!isset($data['fdata']['alerts']))
				{
					$data['fdata']['alerts'] = [];
				}

				array_push(
					$data['fdata']['alerts'],
					[
						'type' => 'danger',
						'title' => '😱 Error occurred when trying to display records list:',
						'bullets' => [
							$response['message']
						]
					]
				);
			}
			else
			{
				$data['records'] = $response;
			}
		}

		$this->load->view('common/top', $data);
		$this->load->view('common/searchbar');
		$this->load->view('common/mid');
		$this->load->view('record/list', $data);
		$this->load->view('common/bottom');
	}

	public function search()
	{	
		$this->form_validation->set_rules(
			'query',
			'Query',
			'required|alpha_numeric_spaces',
			[
				'required' => "%s can't be empty.",
				'alpha_numeric_spaces' => "%s can only be alphanumeric."
			]
		);

		if ($this->form_validation->run() == FALSE)
		{
			$fdata['search_query_validation_errors'] = validation_errors();

			$this->session->set_flashdata('fdata', $fdata);
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$search_query = $this->input->post('query');
			$fdata['search_query'] = $search_query;

			$response = $this->record_model->search($search_query);

			$fdata;
			if (isset($response['error']))
			{
				$fdata['alerts'] = [
					[
						'type' => 'danger',
						'title' => "😵 Error occurred when performing search using <strong>{$search_query}</strong> as query:",
						'bullets' => [
							$response['message']
						]
					]
				];
				$fdata['search_results'] = [];
			}
			else
			{
				$total_results = count($response);

				$str = [
					'type' => $total_results > 0 ? 'primary' : 'warning',
					'emoji' => $total_results > 0 ? '🧐' : '😩',
					'plural' => $total_results > 1 ? 's' : FALSE
				];

				$fdata['alerts'] = [
					[
						'type' => $str['type'],
						'title' => "{$str['emoji']} Search for <strong>{$search_query}</strong> returned <strong>{$total_results}</strong> result{$str['plural']}"
					]
				];
				$fdata['search_results'] = $response;
			}

			$this->session->set_flashdata('fdata', $fdata);
			redirect('record/list');
		}
	}

	public function add()
	{
		$data = [
			'title' => 'Add New Record',
			'operation' => 'add'
		];

		$this->form_validation->set_rules('amount', 'Amount', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('recordtype', 'Record Type', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->displayFormPage($data);
		}
		else
		{
			$response = $this->record_model->insert();

			$this->form_validation->set_rules(
				'receipt',
				'Receipt',
				[
					[
						'receipt_callable',
						function($value) use ($response)
						{
							if (isset($response['error']))
							{
								$this->form_validation->set_message('receipt_callable', $response['message']);
								return FALSE;
							}

							return TRUE;
						}
					]
				]
			);

			if ($this->form_validation->run() == FALSE)
			{
				$this->displayFormPage($data);
			}
			else
			{
				$str = [
					'type' => $response['created']['amount'] < 0 ? 'expense' : 'income',
					'conjunction' => $response['created']['amount'] < 0 ? 'for' : 'from'
				];

				$fdata['alerts'] = [
					[
						'type' => 'primary',
						'title' => '👌 Successfully:',
						'bullets' => [
							"Recorded <strong>{$response['created']['amount']} $</strong> {$str['type']} {$str['conjunction']} <strong>{$response['created']['name']}</strong> and its details to the database"
						]
					]
				];

				if ($response['created']['attachment'] !== '')
				{
					array_push(
						$fdata['alerts'][count($fdata['alerts']) - 1]['bullets'],
						"Uploaded the corresponding receipt to <strong><a href=\"{$response['created']['attachment']}\" target=\"_blank\">link <i class=\"fa fa-external-link-alt\"></i></a></strong>"
					);
				}

				$this->session->set_flashdata('fdata', $fdata);
				redirect('record/list');
			}
		}
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Edit Record',
			'operation' => 'edit',
			'id' => $id
		];

		$this->form_validation->set_rules('amount', 'Amount', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('recordtype', 'Record Type', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			if (validation_errors() == '')
			{
				$response = $this->record_model->get($id);

				if (isset($response['error']))
				{
					if ($response['code'] == 'ID404')
					{
						show_404();
					}
					else
					{
						$fdata['alerts'] = [
							[
								'type' => 'danger',
								'title' => '🙃 Error occurred when trying to edit the record:',
								'bullets' => [
									$response['message']
								]
							]
						];

						$this->session->set_flashdata('fdata', $fdata);
						redirect('record/list');
					}
				}
				else
				{
					$data['editable_record'] = $response;
				}
			}

			$this->displayFormPage($data);
		}
		else
		{
			$response = $this->record_model->edit($id);

			$this->form_validation->set_rules(
				'receipt',
				'Receipt',
				[
					[
						'receipt_callable',
						function($value) use ($response)
						{
							if (isset($response['error']))
							{
								$this->form_validation->set_message('receipt_callable', $response['message']);
								return FALSE;
							}

							return TRUE;
						}
					]
				]
			);

			if ($this->form_validation->run() == FALSE)
			{
				$this->displayFormPage($data);
			}
			else
			{
				$diff_count = count($response['updated']);

				$fdata['alerts'] = [
					[
						'type' => 'primary',
						'title' => '👍 Successfully updated the following field' . ($diff_count > 1 ? 's' : FALSE) . " of Record #<strong>{$id}</strong>:",
						'bullets' => []
					]
				];

				foreach ($response['updated'] as $field => $pair)
				{
					$uppercase_key = ucfirst($field);

					if ($field == 'date')
					{
						foreach ($pair as $k => $v)
						{
							$formatted_date = date('M d, Y h:i A', strtotime($v));
							$response['updated'][$field][$k] = "<strong>{$formatted_date}</strong>";
						}
					}
					elseif ($field == 'notes')
					{
						foreach ($pair as $k => $v)
						{
							if ($v == '')
							{
								$v = 'null';
							}

							$response['updated'][$field][$k] = "<strong>{$v}</strong>";
						}
					}
					elseif ($field == 'attachment')
					{
						foreach ($pair as $k => $v)
						{
							if ($v == '')
							{
								$v = '<strong>null</strong>';
							}
							else
							{
								$v = "<strong><a href=\"{$v}\" target=\"_blank\">{$k} image <i class=\"fa fa-external-link-alt\"></i></a></strong>" . ($k == 'old' ? ' (should no longer be found)' : FALSE);
							}

							$response['updated'][$field][$k] = $v;
						}
					}
					else
					{
						foreach ($pair as $k => $v)
						{
							$response['updated'][$field][$k] = "<strong>{$v}</strong>";
						}
					}

					array_push(
						$fdata['alerts'][count($fdata['alerts']) - 1]['bullets'],
						"<strong>{$uppercase_key}</strong> field, from {$response['updated'][$field]['old']} to {$response['updated'][$field]['new']}"
					);
				}

				if (isset($response['warning']))
				{
					array_push(
						$fdata['alerts'],
						[
							'type' => 'warning',
							'title' => '😓 While the record was successfully updated, error occurred when trying to delete the old receipt:',
							'bullets' => [
								$response['message']
							]
						]
					);
				}				

				$this->session->set_flashdata('fdata', $fdata);
				redirect('record/list');
			}
		}
	}

	public function delete($id) {
		$response = $this->record_model->delete($id);

		if (isset($response['error']))
		{
			if ($response['code'] == 'ID404')
			{
				show_404();
			}
			else
			{
				$fdata['alerts'] = [
					[
						'type' => 'danger',
						'title' => '😕 Error occurred when trying to delete the record:',
						'bullets' => [
							$response['message']
						]
					]
				];

				$this->session->set_flashdata('fdata', $fdata);
				redirect('record/list');
			}
		}
		else
		{
			$str = [
				'type' => $response['deleted']['amount'] < 0 ? 'expense' : 'income',
				'conjunction' => $response['deleted']['amount'] < 0 ? 'for' : 'from'
			];

			$fdata['alerts'] = [
				[
					'type' => 'info',
					'title' => '🙏 Deleted:',
					'bullets' => [
						"Record about <strong>{$response['deleted']['amount']} $</strong> {$str['type']} {$str['conjunction']} <strong>{$response['deleted']['name']}</strong> and its details from the database"
					]
				]
			];

			if ($response['deleted']['attachment'] !== '')
			{
				array_push(
					$fdata['alerts'][count($fdata['alerts']) - 1]['bullets'],
					"The corresponding receipt from the storage bucket, so <strong><a href=\"{$response['deleted']['attachment']}\" target=\"_blank\">link <i class=\"fa fa-external-link-alt\"></i></a></strong> should no longer be found"
				);
			}

			$this->session->set_flashdata('fdata', $fdata);
			redirect('record/list');
		}
    }

	private function displayFormPage($data)
	{
		$this->load->view('common/top', $data);
		$this->load->view('common/mid');
		$this->load->view('record/form', $data);
		$this->load->view('common/bottom');
	}
}
