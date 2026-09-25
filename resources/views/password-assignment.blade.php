<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attribuer Mot de Passe | Technovore Hackathon 2026</title>
  <link rel="icon" href="{{asset('images/app/logoSDI-PhotoRoom.png')}}" type="image/png">
  <link rel="stylesheet" href="{{ mix('css/hackathon-theme.css') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <style>
    body { background-color: var(--bg-dark) !important; color: var(--text-primary) !important; }
    .auth-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      background: radial-gradient(circle at top right, rgba(0, 245, 255, 0.05), transparent),
                  radial-gradient(circle at bottom left, rgba(255, 107, 53, 0.05), transparent);
    }
    .auth-card {
      background: rgba(10, 22, 40, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(0, 245, 255, 0.2);
      border-radius: 24px;
      padding: 48px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      text-align: center;
    }
    .auth-card h1 {
      font-family: var(--font-display);
      font-size: 1.8rem;
      font-weight: 800;
      color: var(--text-primary);
      margin-bottom: 8px;
    }
    .auth-card p {
      color: var(--text-muted);
      margin-bottom: 32px;
      font-size: 0.95rem;
    }
    .form-group {
      text-align: left;
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-size: 0.8rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 8px;
    }
    .form-group input {
      width: 100%;
      padding: 12px 16px;
      background: rgba(6, 11, 20, 0.8);
      border: 1px solid rgba(0, 245, 255, 0.2);
      border-radius: 8px;
      color: var(--text-primary);
      font-size: 1rem;
      transition: var(--transition);
    }
    .form-group input:focus {
      border-color: var(--neon-cyan);
      box-shadow: 0 0 0 3px rgba(0, 245, 255, 0.1);
      outline: none;
    }
    .submit-btn {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, var(--neon-cyan), #0099ff);
      color: #060b14;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      cursor: pointer;
      transition: var(--transition);
      margin-top: 12px;
    }
    .submit-btn:hover {
      box-shadow: var(--glow-cyan);
      transform: translateY(-1px);
    }
    .logo-container {
      margin-bottom: 32px;
    }
    .logo-container img {
      height: 60px;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-card">
      <div class="logo-container">
        <img src="{{ asset('images/app/logoHackathon-PhotoRoom.png') }}" alt="Hackathon 2026">
      </div>
      <h1>Attribuer mot de passe</h1>
      <p>Sécurisez votre compte en choisissant votre propre mot de passe.</p>
      
      <form method="POST" action="{{ route('password.assign') }}">
        @csrf
        <div class="form-group">
          <label for="password">Nouveau Mot de Passe</label>
          <input type="password" id="password" name="password" required autofocus>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirmation</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="submit-btn">Valider le mot de passe</button>
      </form>
    </div>
  </div>
</body>
</html>
