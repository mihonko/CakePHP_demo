<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewsController extends AppController
{
    public $paginate = [
        'contain' => 'Shops',
        'limit' => 20,
        'order' => [
            'release_date' => 'DESC'
        ]
    ];

    /**
     * list method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function list()
    {
        $news = $this->paginate($this->News);

        $this->set(compact('news'));
    }

    /**
     * detail method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function detail($id = null)
    {
        $news = $this->News->get($id, [
            'contain' => 'Shops',
        ]);

        $this->set(compact('news'));
    }
}
