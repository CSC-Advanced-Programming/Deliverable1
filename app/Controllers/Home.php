<?php

namespace App\Controllers;

use App\Libraries\JsonDB;

class Home extends BaseController
{
    public function index(): string
    {
        $dbFiles = [
            'programs'             => 'programs.json',
            'facilities'           => 'facilities.json',
            'projects'             => 'projects.json',
            'participants'         => 'participants.json',
            'services'             => 'services.json',
            'equipment'            => 'equipment.json',
            'outcomes'             => 'outcomes.json',
            'project_participants' => 'project_participants.json',
        ];

        $stats = [];
        $dbs   = [];
        foreach ($dbFiles as $key => $file) {
            $db          = new JsonDB($file);
            $dbs[$key]   = $db->all();
            $stats[$key] = count($dbs[$key]);
        }

        $data = [
            'title'          => 'Dashboard',
            'active'         => 'dashboard',
            'stats'          => $stats,
            'recentProjects' => array_slice(array_reverse($dbs['projects']), 0, 5),
            'programs'       => $dbs['programs'],
            'facilities'     => $dbs['facilities'],
        ];

        return view('dashboard', $data);
    }
}
