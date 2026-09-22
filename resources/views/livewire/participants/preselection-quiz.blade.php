<div style="padding:32px 24px;max-width:1000px;margin:0 auto;">

    @if($isSubmitted)
        <div class="glass-card" style="padding:48px;text-align:center;min-height:400px;display:flex;flex-direction:column;justify-content:center;align-items:center;">
            <div style="font-size:5rem;margin-bottom:24px;" aria-hidden="true">🎉</div>
            <h1 style="font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--text-primary);margin-bottom:12px;">Quiz Terminé !</h1>
            <p style="font-size:1.2rem;color:var(--text-muted);margin-bottom:32px;">
                Votre équipe a obtenu un score de <span style="color:var(--neon-cyan);font-weight:800;font-size:1.5rem;">{{ $finalScore }} / {{ $totalScore }}</span>
            </p>
            <a href="{{ route('dashboard') }}" style="padding:12px 24px;background:var(--neon-cyan);color:#0a1628;border-radius:8px;font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:0.05em;">Retour au Dashboard</a>
        </div>
    @elseif(!$isQuizOpen)
        <div class="glass-card" style="padding:48px;text-align:center;min-height:400px;display:flex;flex-direction:column;justify-content:center;align-items:center;">
            <div style="font-size:5rem;margin-bottom:24px;" aria-hidden="true">🔒</div>
            <h1 style="font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--text-primary);margin-bottom:12px;">Quiz Fermé</h1>
            <p style="font-size:1.2rem;color:var(--text-muted);margin-bottom:32px;">
                Désolé, le quiz pour votre niveau est actuellement fermé. Veuillez contacter l'administration.
            </p>
            <a href="{{ route('dashboard') }}" style="padding:12px 24px;background:var(--neon-cyan);color:#0a1628;border-radius:8px;font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:0.05em;">Retour au Dashboard</a>
        </div>
    @else
        <div class="glass-card" style="padding:40px;position:relative;">
            <!-- Progress Bar -->
            <div style="margin-bottom:32px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <span style="font-size:0.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;">
                        Question {{ $currentQuestionIndex + 1 }} sur {{ count($questions) }}
                    </span>
                    <span style="font-size:0.8rem;color:var(--neon-cyan);font-weight:700;">{{ round(($currentQuestionIndex + 1) / count($questions) * 100) }}%</span>
                </div>
                <div style="width:100%;height:6px;background:rgba(255,255,255,0.1);border-radius:10px;overflow:hidden;">
                    <div style="width:{{ ($currentQuestionIndex + 1) / count($questions) * 100 }}%;height:100%;background:var(--neon-cyan);box-shadow:0 0 10px var(--neon-cyan);transition:width 0.3s ease;"></div>
                </div>
            </div>

            <!-- Question -->
            <div style="margin-bottom:32px;">
                <h2 style="font-family:var(--font-display);font-size:1.4rem;font-weight:700;color:var(--text-primary);line-height:1.4;margin-bottom:24px;">
                    {{ $questions[$currentQuestionIndex]->content }}
                </h2>

                <div style="display:grid;grid-template-columns:1fr;gap:12px;">
                    @foreach($questions[$currentQuestionIndex]->responses as $response)
                        <div wire:click="selectResponse({{ $questions[$currentQuestionIndex]->id }}, {{ $response->id }})"
                             style="padding:16px;border:1px solid var(--glass-border);border-radius:12px;cursor:pointer;transition:all 0.2s;
                             background:{{ isset($userResponses[$questions[$currentQuestionIndex]->id]) && $userResponses[$questions[$currentQuestionIndex]->id] == $response->id ? 'rgba(0,245,255,0.15)' : 'rgba(255,255,255,0.03)' }};
                             border-color:{{ isset($userResponses[$questions[$currentQuestionIndex]->id]) && $userResponses[$questions[$currentQuestionIndex]->id] == $response->id ? 'var(--neon-cyan)' : 'var(--glass-border)' }};">

                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:20px;height:20px;border-radius:50%;border:2px solid var(--neon-cyan);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:var(--neon-cyan);
                                {{ isset($userResponses[$questions[$currentQuestionIndex]->id]) && $userResponses[$questions[$currentQuestionIndex]->id] == $response->id ? 'background:var(--neon-cyan);color:#0a1628;' : '' }}">
                                    ✓
                                </div>
                                <span style="font-size:0.95rem;color:{{ isset($userResponses[$questions[$currentQuestionIndex]->id]) && $userResponses[$questions[$currentQuestionIndex]->id] == $response->id ? 'var(--neon-cyan)' : 'var(--text-primary)' }};">
                                    {{ $response->content }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation -->
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:40px;">
                <button wire:click="prevQuestion" style="padding:10px 20px;background:none;border:1px solid var(--glass-border);color:var(--text-muted);border-radius:8px;cursor:pointer;transition:var(--transition);{{ $currentQuestionIndex == 0 ? 'opacity:0.5;pointer-events:none;' : '' }}">
                    ← Précédent
                </button>

                @if($currentQuestionIndex < count($questions) - 1)
                    <button wire:click="nextQuestion" style="padding:10px 20px;background:var(--neon-cyan);color:#0a1628;border:none;border-radius:8px;font-weight:700;cursor:pointer;transition:var(--transition);">
                    Suivant →
                    </button>
                @else
                    <button wire:click="submitQuiz" style="padding:10px 20px;background:#00ff7f;color:#0a1628;border:none;border-radius:8px;font-weight:700;cursor:pointer;transition:var(--transition);">
                    Soumettre le Quiz ✓
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>