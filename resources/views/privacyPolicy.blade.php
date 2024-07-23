@extends('main')


@section('content')
    <div class="container">
        <div class="mt-3">
            <h3>{{ __('home.privacy_policy_title') }}</h3>
            <p><a href="https://moemortezaei.netlify.app/" target="_blank">Moe Mortezaei</a></p>
            <p>{{ __('home.privacy_policy_intro') }}</p>

            <h3>{{ __('home.information_collection_and_use_title') }}</h3>
            <p>{{ __('home.information_collection_and_use_intro') }}</p>

            <h4>{{ __('home.log_data_title') }}</h4>
            <p>{{ __('home.log_data_description') }}</p>

            <h4>{{ __('home.cookies_and_third_party_advertising_title') }}</h4>
            <p>{{ __('home.cookies_and_third_party_advertising_description') }}</p>

            <h4>{{ __('home.web_forms_on_our_site_title') }}</h4>
            <p>{{ __('home.web_forms_on_our_site_description') }}</p>

            <h4>{{ __('home.security_title') }}</h4>
            <p>{{ __('home.security_description') }}</p>

            <h4>{{ __('home.links_to_other_sites_title') }}</h4>
            <p>{{ __('home.links_to_other_sites_description') }}</p>

            <h4>{{ __('home.childrens_privacy_title') }}</h4>
            <p>{{ __('home.childrens_privacy_description') }}</p>

            <h4>{{ __('home.changes_to_this_privacy_policy_title') }}</h4>
            <p>{{ __('home.changes_to_this_privacy_policy_description') }}</p>



        </div>
    </div>
@endsection
