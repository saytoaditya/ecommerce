<div class="container custom-login" >
    <div class="row">
        <div class="col-sm-5 ">
        <form method="POST" action="register">
        @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" required aria-describedby="emailHelp" placeholder="name">
                        <span>@error    ('name'){{'message'}}  @enderror</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" required placeholder="Enter email">
                    <span>@error    ('email'){{'message'}}  @enderror</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" required placeholder="Password">
                    <span>@error    ('password'){{'message'}}  @enderror</span>
                </div>
                
                <button type="submit" class="btn btn-primary">register</button>
        </form>
        </div>
    </div>
</div> 