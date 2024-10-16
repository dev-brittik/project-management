@php
    $roles = App\Models\Role::all();
@endphp
<div class="ol-card p-3">
    <div class="ol-card-body">
        <div class="row">
            <div class="col-6">
                <form action="{{ route(get_current_user_role() . '.user.update', $user->id) }}" method="post"
                    id="">@csrf
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="name">{{ get_phrase('Name') }}</label>
                        <input class="form-control ol-form-control" type="text" id="name" name="name"
                            value="{{ $user->name }}" required>
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="email">{{ get_phrase('Email') }}</label>
                        <input class="form-control ol-form-control" type="email" id="email" name="email"
                            value="{{ $user->email }}" required>
                    </div>
                    <div class="fpb-7 mb-3">
                        <label class="form-label ol-form-label" for="role_id">{{ get_phrase('User Type') }}</label>
                        <select class="form-control ol-form-control ol-select2" data-toggle="select2" multiple
                            name="roles[]" id="role_id" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if (in_array($role->id, $user->roles->pluck('id')->toArray() ?? [])) selected @endif>
                                    {{ $role->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fpb7 mb-2">
                        <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Edit user') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('ajax')
