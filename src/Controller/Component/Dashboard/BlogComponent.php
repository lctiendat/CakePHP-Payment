<?php

declare(strict_types=1);

namespace App\Controller\Component\Dashboard;

use App\Controller\Component\AppComponent;

class BlogComponent extends AppComponent
{

    public function listBlog()
    {
        $query = $this->Blogs->find()
            ->where([
                'delete_flag' => 0
            ])
            ->order(['id' => 'desc']);
        return $query;
    }

    public function saveBlog($data)
    {
        $query = $this->Blogs->query();
        if (empty($data['id'])) {
            $query->insert([
                'title',
                'description',
                'content',
                'thumbnail',
                'slug',
                'created',
                'modified'
            ])->values($data)
                ->execute();
        } else {
            $query->update()
                ->set([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'content' => $data['content'],
                    'thumbnail' => $data['thumbnail'],
                    'created' => $data['created'],
                    'modified' => $data['modified']
                ])
                ->where([
                    'id' => $data['id']
                ])
                ->execute();
        }
    }
    public function deleteBlog($id)
    {
        $query = $this->Blogs->query();
        $query->update()
            ->set(['delete_flag' => 1])
            ->where(['id' => $id])
            ->execute();
    }

    public function getBlogById($id)
    {
        $query = $this->Blogs->find()
            ->where([
                'delete_flag' => 0,
                'id' => $id
            ])
            ->first();
        return $query;
    }
}
