public function api()
{
    $model = new PostModel();
    return $this->response->setJSON($model->findAll());
}