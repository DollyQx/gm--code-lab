@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">Client Account Profile</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Manage your account credentials and business organization information.</p>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('client.profile.update') }}">
            @csrf
            @method('PUT')

            <h3 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; color: #60a5fa;">Account & Personal Details</h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem;">
                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Email Address (Read-only)</label>
                    <input type="email" value="{{ $user->email }}" disabled class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(17, 24, 39, 0.8); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-muted); cursor: not-allowed;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? $profile->phone) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>
            </div>

            <h3 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; color: #a78bfa;">Company & Business Details</h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem;">
                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Company / Organization Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Contact Person</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person', $profile->contact_person) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">GST / VAT Number</label>
                    <input type="text" name="gst_vat_number" value="{{ old('gst_vat_number', $profile->gst_vat_number) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Industry / Sector</label>
                    <input type="text" name="industry" value="{{ old('industry', $profile->industry) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Website URL</label>
                    <input type="url" name="website" value="{{ old('website', $profile->website) }}" placeholder="https://example.com" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>
            </div>

            <h3 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; color: #34d399;">Billing & Address Details</h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
                <div style="grid-column: 1 / -1;">
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Address Line 1</label>
                    <input type="text" name="address_line1" value="{{ old('address_line1', $profile->address_line1) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">City</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">State / Province</label>
                    <input type="text" name="state" value="{{ old('state', $profile->state) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Postal Code</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>

                <div>
                    <label class="form-label" style="display: block; font-size: 0.875rem; margin-bottom: 0.5rem;">Country</label>
                    <input type="text" name="country" value="{{ old('country', $profile->country) }}" class="form-input" style="width: 100%; padding: 0.75rem; background: rgba(31, 41, 55, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: #fff;">
                </div>
            </div>

            <button type="submit" style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple)); color: #fff; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                Save Profile Changes
            </button>
        </form>
    </div>
@endsection
