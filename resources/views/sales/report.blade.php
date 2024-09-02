<h1>Sales Report</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Commission Rate</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->product_name }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->commissionRate->rate }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>

