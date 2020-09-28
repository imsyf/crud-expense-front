<?php
use GuzzleHttp\Client;

class Record_model extends CI_Model
{
	
	private $client;

	public function __construct()
	{
		$this->client = new Client(
			[
				'base_uri' => getenv('API_BASE_URL'),
				'http_errors' => false
			]
		);
	}

	public function ping()
	{
		$response = $this->client->request('GET', '/ping', []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function getMonthlySummary()
	{
		$response = $this->client->request('GET', '/record/summary', []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function getRecent($limit = 10)
	{
		$response = $this->client->request('GET', '/record/list?order_by=date%3Adesc&limit='.$limit, []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function getTopExpenses($limit = 10)
	{
		$response = $this->client->request('GET', '/record/list?type=out&order_by=amount&limit='.$limit, []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function getAll()
	{
		$response = $this->client->request('GET', '/record/list', []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function get($id)
	{
		$response = $this->client->request('GET', '/record/'.$id, []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function search($q)
	{
		$response = $this->client->request('GET', '/record/search/'.$q, []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function insert()
	{
		$form = [
			'multipart' => [
				[
					'name' => 'amount',
					'contents' => ($this->input->post('recordtype') == 'income' ? $this->input->post('amount') : $this->input->post('amount') * -1)
				],
				[
					'name' => 'name',
					'contents' => $this->input->post('name')
				],
				[
					'name' => 'date',
					'contents' => $this->input->post('date')
				],
				[
					'name' => 'notes',
					'contents' => $this->input->post('notes')
				]
			]
		];

		if ($_FILES['attachment']['tmp_name'] !== '')
		{
			array_push(
				$form['multipart'],
				[
					'name' => 'attachment',
					'contents' => fopen($_FILES['attachment']['tmp_name'], 'r')
				]
			);
		}

		$response = $this->client->request('POST', '/record/create', $form);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function edit($id)
	{
		$form = [
			'multipart' => [
				[
					'name' => 'amount',
					'contents' => ($this->input->post('recordtype') == 'income' ? $this->input->post('amount') : $this->input->post('amount') * -1)
				],
				[
					'name' => 'name',
					'contents' => $this->input->post('name')
				],
				[
					'name' => 'date',
					'contents' => $this->input->post('date')
				],
				[
					'name' => 'notes',
					'contents' => $this->input->post('notes')
				]
			]
		];

		if ($_FILES['attachment']['tmp_name'] !== '')
		{
			array_push(
				$form['multipart'],
				[
					'name' => 'attachment',
					'contents' => fopen($_FILES['attachment']['tmp_name'], 'r')
				]
			);
		}

		$response = $this->client->request('PUT', '/record/update/'.$id, $form);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function delete($id)
	{
		$response = $this->client->request('DELETE', '/record/'.$id, []);
		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}
}
