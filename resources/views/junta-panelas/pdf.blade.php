<!doctype html>
<html lang="{{ strtolower(str_replace('_', '-', app()->getLocale())) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>{{ $juntaPanelas->title }}</title>
        <style>
            .container {
                text-align: center;
                font-family: sans-serif;
                color: rgba(0, 0, 0, 0.87);
            }

            .header > h1 {
                margin-top: 5rem;
                font-size: 1.8rem;
                font-weight: bold;
            }

            .header > p {
                font-weight: bold;
                color: rgba(0, 0, 0, 0.5);
            }

            table {
                width: 100%;
                margin-top: 3rem;
                border-spacing: unset;
            }

            tr:nth-child(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            td {
                padding: 0.75rem;
                font-weight: bold;
                color: rgba(0, 0, 0, 0.6);
            }

            .items {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1>{{ $juntaPanelas->title }}</h1>
                <p>{{ date('d/m/Y · H:i', strtotime($juntaPanelas->date)) }}</p>
            </div>
            <table>
                @foreach($juntaPanelas->participants->sortBy('name') as $participant)
                    <tr>
                        <td class="name">{{ $participant->name }}</td>
                        <td class="items">{{ implode(' · ', $participant->items) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
