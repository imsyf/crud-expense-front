<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('record_model');
	}

    public function index()
	{
		$this->load->helper('form');
		$this->load->library('session');

		$data['title'] = 'Dashboard';
		$data['fdata'] = $this->session->flashdata('fdata');

		$summary_response = $this->record_model->getMonthlySummary();
		if (isset($summary_response['error']))
		{
			$data['alerts'] = [];
			array_push(
				$data['alerts'],
				[
					'type' => 'danger',
					'title' => '😬 Error occurred when trying to display monthly overview:',
					'bullets' => [
						$summary_response['message']
					]
				]
			);
		}
		else
		{
			$data['summary'] = $summary_response;
		}

		$recent_response = $this->record_model->getRecent();
		if (isset($recent_response['error']))
		{
			if (!isset($data['alerts']))
			{
				$data['alerts'] = [];
			}

			array_push(
				$data['alerts'],
				[
					'type' => 'danger',
					'title' => '🤔 Error occurred when trying to display recent records:',
					'bullets' => [
						$recent_response['message']
					]
				]
			);
		}
		else
		{
			$data['recent_records'] = $recent_response;
		}

		$expenses_response = $this->record_model->getTopExpenses();
		if (isset($expenses_response['error']))
		{
			if (!isset($data['alerts']))
			{
				$data['alerts'] = [];
			}

			array_push(
				$data['alerts'],
				[
					'type' => 'danger',
					'title' => '🥴 Error occurred when trying to display top expenses:',
					'bullets' => [
						$expenses_response['message']
					]
				]
			);
		}
		else
		{
			$data['top_expenses'] = $expenses_response;
		}

		$this->load->view('common/top', $data);
		$this->load->view('common/searchbar');
		$this->load->view('common/mid');
		$this->load->view('dashboard', $data);
		$this->load->view('common/bottom');
	}

	public function ping()
	{
		$data['data'] = $this->record_model->ping();
		$this->load->view('ping', $data);
	}
}
