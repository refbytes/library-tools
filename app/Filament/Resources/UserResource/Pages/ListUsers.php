<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\TeamInvitationMail;
use App\Models\Invitation;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Mail;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('inviteUser')
                ->visible(fn () => auth()->user()->hasRole('admin'))
                ->form([
                    TextInput::make('email')
                        ->email()
                        ->required(),
                ])
                ->action(function ($data) {
                    $userExists = User::query()
                        ->where('email', $data['email'])
                        ->exists();

                    if ($userExists) {
                        Notification::make('userExists')
                            ->body('A user with this email already exists!')
                            ->danger()
                            ->send();

                        return;
                    }

                    $invitation = Invitation::create([
                        'email' => $data['email'],
                    ]);

                    Mail::to($invitation->email)
                        ->send(new TeamInvitationMail($invitation));

                    Notification::make('invitedSuccess')
                        ->body('User invited successfully!')
                        ->success()
                        ->send();
                }),
        ];
    }
}
