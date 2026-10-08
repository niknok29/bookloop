# BookLoop architecture

BookLoop is a Laravel 12 modular monolith. Controllers own request boundaries, Eloquent models own persistence relationships, and future Actions/Services will own take/put workflows. Blade is the presentation layer; Livewire is installed for interactive slices. Events, listeners, notifications and the scheduler are extension points for reminders and wishlist matching.

The foundation does not claim take/put, rewards, QR scanning, notifications or admin CRUD are complete.
