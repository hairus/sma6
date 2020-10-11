<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurnals;
use App\Models\Kelas;
use App\Models\ta;
use App\Models\kd;
use App\Models\mapels;
use App\Models\Gurus;
use App\Models\siswa;
use App\Models\AbsenGuru;
use App\User;
use Auth;
use DB;


class denahController extends Controller
{
	public function test()
	{
		return 'ini adalah tempat untuk denah';
	}
	public function index()
    {
      $cek = AbsenGuru::where('date', date('Ymd'))->orderBy('jam_ke', 'DESC')->first();

        $k1 = AbsenGuru::where([
            ['kelas_id', 1],
            ['date', date('Ymd')]
        ])
            ->orderBy('jam_ke', 'DESC')
            ->first();

        if($k1 === null)
        {  $k1 = null;  }
        else
        {
          $k1 = AbsenGuru::where([
              ['kelas_id', 1],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k2 = AbsenGuru::where([
            ['kelas_id', 2],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k2 === null)
        {  $k2 = null;   }
        else
        {
          $k2 = AbsenGuru::where([
              ['kelas_id', 2],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k3 = AbsenGuru::where([
            ['kelas_id', 3],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k3 === null)
        {
          $k3 = null;
        }
        else
        {
          $k3 = AbsenGuru::where([
              ['kelas_id', 3],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k4 = AbsenGuru::where([
            ['kelas_id', 4],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k4 === null)
        {
          $k4 = null;
        }
        else
        {
          $k4 = AbsenGuru::where([
              ['kelas_id', 4],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k5 = AbsenGuru::where([
            ['kelas_id', 5],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k5 === null)
        {
          $k5 = null;
        }
        else
        {
          $k5 = AbsenGuru::where([
              ['kelas_id', 5],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k6 = AbsenGuru::where([
            ['kelas_id', 6],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k6 === null)
        {
          $k6 = null;
        }
        else
        {
          $k6 = AbsenGuru::where([
              ['kelas_id', 6],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k7 = AbsenGuru::where([
            ['kelas_id', 7],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k7 === null)
        {
          $k7 = null;
        }
        else
        {
          $k7 = AbsenGuru::where([
              ['kelas_id', 7],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k8 = AbsenGuru::where([
            ['kelas_id', 8],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k8 === null)
        {
          $k8 = null;
        }
        else
        {
          $k8 = AbsenGuru::where([
              ['kelas_id', 8],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k9 = AbsenGuru::where([
            ['kelas_id', 9],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k9 === null)
        {  $k9 = null;  }
        else
        {
          $k9 = AbsenGuru::where([
              ['kelas_id', 9],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k10 = AbsenGuru::where([
            ['kelas_id', 10],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k10 === null)
        {  $k10 = null;   }
        else
        {
          $k10 = AbsenGuru::where([
              ['kelas_id', 10],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k11 = AbsenGuru::where([
            ['kelas_id', 11],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k11 === null)
        {  $k11 = null;  }
        else
        {
          $k11 = AbsenGuru::where([
              ['kelas_id', 11],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k12 = AbsenGuru::where([
            ['kelas_id', 12],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k12 === null)
        {  $k12 = null;   }
        else
        {
          $k12 = AbsenGuru::where([
              ['kelas_id', 12],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k13 = AbsenGuru::where([
            ['kelas_id', 13],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k13 === null)
        {
          $k13 = null;
        }
        else
        {
          $k13 = AbsenGuru::where([
              ['kelas_id', 13],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k14 = AbsenGuru::where([
            ['kelas_id', 14],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k14 === null)
        {
          $k14 = null;
        }
        else
        {
          $k14 = AbsenGuru::where([
              ['kelas_id', 14],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k15 = AbsenGuru::where([
            ['kelas_id', 15],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k15 === null)
        {
          $k15 = null;
        }
        else
        {
          $k15 = AbsenGuru::where([
              ['kelas_id', 15],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k16 = AbsenGuru::where([
            ['kelas_id', 16],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k16 === null)
        {
          $k16 = null;
        }
        else
        {
          $k16 = AbsenGuru::where([
              ['kelas_id', 16],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k17 = AbsenGuru::where([
            ['kelas_id', 17],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k17 === null)
        {
          $k17 = null;
        }
        else
        {
          $k17 = AbsenGuru::where([
              ['kelas_id', 17],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k18 = AbsenGuru::where([
            ['kelas_id', 18],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k18 === null)
        {
          $k18 = null;
        }
        else
        {
          $k18 = AbsenGuru::where([
              ['kelas_id', 18],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k19 = AbsenGuru::where([
            ['kelas_id', 19],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k19 === null)
        {  $k19 = null;  }
        else
        {
          $k19 = AbsenGuru::where([
              ['kelas_id', 19],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k20 = AbsenGuru::where([
            ['kelas_id', 20],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k20 === null)
        {  $k20 = null;   }
        else
        {
          $k20 = AbsenGuru::where([
              ['kelas_id', 20],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k21 = AbsenGuru::where([
            ['kelas_id', 21],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k21 === null)
        {  $k21 = null;  }
        else
        {
          $k21 = AbsenGuru::where([
              ['kelas_id', 21],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k22 = AbsenGuru::where([
            ['kelas_id', 22],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k22 === null)
        {  $k22 = null;   }
        else
        {
          $k22 = AbsenGuru::where([
              ['kelas_id', 22],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k23 = AbsenGuru::where([
            ['kelas_id', 23],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k23 === null)
        {
          $k23 = null;
        }
        else
        {
          $k23 = AbsenGuru::where([
              ['kelas_id', 23],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k24 = AbsenGuru::where([
            ['kelas_id', 24],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k24 === null)
        {
          $k24 = null;
        }
        else
        {
          $k24 = AbsenGuru::where([
              ['kelas_id', 24],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k25 = AbsenGuru::where([
            ['kelas_id', 25],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k25 === null)
        {
          $k25 = null;
        }
        else
        {
          $k25 = AbsenGuru::where([
              ['kelas_id', 25],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k26 = AbsenGuru::where([
            ['kelas_id', 26],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k26 === null)
        {
          $k26 = null;
        }
        else
        {
          $k26 = AbsenGuru::where([
              ['kelas_id', 26],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k27 = AbsenGuru::where([
            ['kelas_id', 27],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k27 === null)
        {
          $k27 = null;
        }
        else
        {
          $k27 = AbsenGuru::where([
              ['kelas_id', 27],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k28 = AbsenGuru::where([
            ['kelas_id', 28],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k28 === null)
        {
          $k28 = null;
        }
        else
        {
          $k28 = AbsenGuru::where([
              ['kelas_id', 28],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k29 = AbsenGuru::where([
            ['kelas_id', 29],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k29 === null)
        {  $k29 = null;  }
        else
        {
          $k29 = AbsenGuru::where([
              ['kelas_id', 29],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        $k30 = AbsenGuru::where([
            ['kelas_id', 30],
            ['date', date('Ymd')]
        ])->orderBy('jam_ke', 'DESC')->first();

        if($k30 === null)
        {  $k30 = null;   }
        else
        {
          $k30 = AbsenGuru::where([
              ['kelas_id', 30],
              ['date', date('Ymd')]
          ])->orderBy('jam_ke', 'DESC')->first();
        }

        return view('denah',
        [
          'k1' => $k1, 'k2' => $k2, 'k3' => $k3, 'k4' => $k4, 'k5' => $k5,
          'k6' => $k6, 'k7' => $k7, 'k8' => $k8, 'k9' => $k9, 'k10' => $k10,
          'k11' => $k11, 'k12' => $k12, 'k13' => $k13, 'k14' => $k14, 'k15' => $k15,
          'k16' => $k16, 'k17' => $k17, 'k18' => $k18, 'k19' => $k19, 'k20' => $k20,
          'k21' => $k21, 'k22' => $k22, 'k23' => $k23, 'k24' => $k24, 'k25' => $k25,
          'k26' => $k26, 'k27' => $k27, 'k28' => $k28, 'k29' => $k29, 'k30' => $k30
        ]);
    }
    
}
