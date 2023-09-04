<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Vendas</title>
</head>
<body>
    <h1>Relatório de Vendas</h1>

    <p>Olá,</p>

    <p>Aqui está o relatório de vendas do dia:</p>

    <table>
        <thead>
            <tr>
                <th>Data da Venda</th>
                <th>Valor total</th>
                <th>Comissão total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $report["date"] }}</td>
                <td>{{ $report["value"] }}</td>
                <td>{{ $report["commission"] }}</td>
            </tr>
        </tbody>
    </table>

    <p>Se você tiver alguma dúvida, entre em contato conosco.</p>

    <p>Obrigado.</p>
</body>
</html>
