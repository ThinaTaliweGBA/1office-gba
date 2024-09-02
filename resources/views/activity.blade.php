<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity Log</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
    <nav class="container-fluid">
        <ul>
            <li><strong>Activity Log</strong></li>
        </ul>
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/activity') }}">Activity</a></li>
            <li><a href="{{ route('logout') }}" role="button">Logout</a></li>
        </ul>
    </nav>
    <main class="container">
        <div class="grid">
            <section>
                <hgroup>
                    <h2>Activity Log</h2>
                    <h3>Total Activities: {{ $totalActivities }}</h3>
                </hgroup>
                <p>Below is a list of all activities logged in the system:</p>
                @if($activities->isNotEmpty())
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>{{ $activity->userDetails ? $activity->userDetails->name : 'N/A' }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>{{ $activity->ipAddress }}</td>
                                    <td>{{ $activity->userAgentDetails['browser'] ?? 'N/A' }}</td>
                                    <td>{{ $activity->timePassed }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $activities->links() }}
                @else
                    <p>No activities found.</p>
                @endif
                <h3>Search Activities</h3>
                <form method="GET" action="{{ url('/activity') }}">
                    <input type="text" name="description" placeholder="Description" value="{{ request('description') }}">
                    <input type="text" name="user" placeholder="User ID" value="{{ request('user') }}">
                    <input type="text" name="method" placeholder="Method" value="{{ request('method') }}">
                    <input type="text" name="route" placeholder="Route" value="{{ request('route') }}">
                    <input type="text" name="ip_address" placeholder="IP Address" value="{{ request('ip_address') }}">
                    <button type="submit">Search</button>
                </form>
            </section>
        </div>
    </main>
    <section aria-label="Subscribe example">
        <div class="container">
            <article>
                <hgroup>
                    <h2>Stay Updated</h2>
                    <h3>Subscribe to our newsletter</h3>
                </hgroup>
                <form class="grid">
                    <input type="text" id="firstname" name="firstname" placeholder="First Name" aria-label="First Name" required />
                    <input type="email" id="email" name="email" placeholder="Email" aria-label="Email" required />
                    <button type="submit" onclick="event.preventDefault()">Subscribe</button>
                </form>
            </article>
        </div>
    </section>
    <footer class="container">
        <small><a href="#">Privacy Policy</a> • <a href="#">Terms of Service</a></small>
    </footer>
</body>
</html>
