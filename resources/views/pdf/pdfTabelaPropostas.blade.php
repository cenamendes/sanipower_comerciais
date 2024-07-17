<!DOCTYPE html>
<html>
<head>
    <title>Proposta</title>
    <style>
        /* Adicione seus estilos CSS aqui */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Proposta</h1>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>

            {{-- @foreach ($proposta->lines as $line) --}}
                <tr>
                    <td>{{ $proposta}}</td>
                    <td>lkj</td>
                    <td>jk</td>
                </tr>
                  <tr>
                    <td>ji</td>
                    <td>kl</td>
                    <td>yjh</td>
                </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</body>
</html>
