<!-- resources/views/components/access-denied-modal.blade.php -->
@if (Auth::check() && (!Auth::user()->person || !Auth::user()->person->employee) && !session('bypass_access'))
    <div class="modal fade show" id="accessDeniedModal" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Access Denied</h5>
                </div>
                <div class="modal-body">
                    <p>You do not have access to this system as you are not registered as an employee.</p>
                    <form id="bypass-form" method="POST" action="{{ route('bypass.access') }}">
                        @csrf
                        <div class="form-group">
                            <label for="bypass-password">Enter Password to Bypass:</label>
                            <input type="password" name="bypass_password" id="bypass-password" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Bypass</button>
                            <a href="{{ route('logout') }}" class="btn btn-primary"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </div>
                    </form>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif
