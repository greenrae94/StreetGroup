<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;

class CSVReader extends Controller
{
    public function showUploadForm()
    {
        return view('csvreader');
    }

    public function parseCsv(Request $request)
    {
        $people = [];

        if ($request->hasFile('csv_file')) {
            $csvFile = $request->file('csv_file');

            if (($handle = fopen($csvFile, "r")) !== FALSE) {
                while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (strpos($row[0], 'and') !== false || strpos($row[0], '&') !== false) {
                        $names = preg_split('/\s+and\s+|\s*&\s*/i', $row[0]);
                        foreach ($names as $name) {
                            $name = trim($name);
                            if (!strpos($name, ' ')) {
                                $lastWord = explode(' ', $row[0]);
                                $name .= ' ' . end($lastWord);
                            }
                            $name = str_replace('Mister', 'Mr', $name);
                            $people[] = $this->formatPerson($name);
                        }
                    } else {
                        $name = $row[0];
                        $name = str_replace('Mister', 'Mr', $name);
                        $people[] = $this->formatPerson($name);
                    }
                }
                fclose($handle);
                array_shift($people);
            }
        }

        return view('parsed_csv')->with('people', $people);
    }

    private function formatPerson($name)
    {
        $person = [
            'title' => null,
            'first_name' => null,
            'initial' => null,
            'last_name' => null,
        ];

        $nameParts = explode(' ', $name);
        $person['title'] = $nameParts[0];

        $person['last_name'] = end($nameParts);

        if (count($nameParts) == 2) {
            return $person;
        }

        if (count($nameParts) > 2) {
            if (strlen($nameParts[1]) == 1 || preg_match('/^[A-Za-z]\.$/', $nameParts[1])) {
                $person['initial'] = $nameParts[1];
            } else {
                $person['first_name'] = $nameParts[1];
            }
        }

        return $person;
    }
}
