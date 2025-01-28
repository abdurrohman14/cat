<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - CAT Polresta Banyuwangi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
      body {
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: 100vh;
      }
      .login-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 30%;
        height: 50vh;
      }
      .logo {
        margin-bottom: 20px;
        text-align: center;
      }
      .logo img {
        width: 80px;
      }
      .login-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #fdb407;
        text-align: center;
      }
      .login-subtitle {
        font-size: 1rem;
        color: #002855;
        margin-bottom: 10px;
        text-align: center;
        font-weight: 500;
      }
      .btn-login {
        background-color: #fdb407;
        border: none;
        color: #002855;
        font-weight: 500;
      }
      .btn-login:hover {
        background-color: #e0a800;
      }
      .login {
        font-size: 1rem;
        color: #fdb407;
        margin-bottom: 3px;
      }
      .login-subtitle-card {
        color: #002855;
        font-weight: 400;
      }
      .input-group-text i {
        color: #aaa;
        font-size: 1rem;
      }
    </style>
  </head>
  <body>
    <div class="logo">
      <img src="{{ asset('assets/dist/img/logo-polresta.png') }}" alt="Logo Polresta" />
    </div>
    <h2 class="login-title">Computer Assisted Test</h2>
    <p class="login-subtitle">
      Simulasi Ujian Kenaikan Pangkat <br />
      Polresta Banyuwangi
    </p>
    <div class="login-container">
      <div class="title mb-4">
        <h4 class="login">LOGIN</h4>
        <p class="login-subtitle-card">Masukkan email dan password</p>
      </div>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label visually-hidden">Email</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-envelope"></i>
            </span>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}"/>
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label visually-hidden">Password</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-lock"></i>
            </span>
            <input type="password" class="form-control" id="password" name="password" />
          </div>
        </div>
        <button type="submit" class="btn btn-login w-100 mt-4">Login</button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  </body>
</html>
