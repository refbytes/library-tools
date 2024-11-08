<div class="bg-gray-100 p-4">
    <div class="font-semibold text-lg border-b border-1 border-gray-400">
       Available Variables
    </div>
    <div class="flex flex-wrap gap-8 pt-4 ">
        <div>@{{ $subscription->name }}</div>
        <div>@{{ $subscription->full_url }}</div>
        <div>@{!! $subscription->description !!}</div>
        <div>@{{ $subscription->vendor->name }}</div>
        <div>{{ '@'.'foreach' }}($subscription->subjects as $subject)  @{{ $subject->name }} {{ '@'.'endforeach' }}</div>
        <div>{{ '@'.'foreach' }}($subscription->formats as $format)  <div>{{ '@'.'if' }}(array_key_exists($format->name, $icons)) {{ '@'.'svg' }}($icons[$format->name], 'w-5 h-5 text-gray-500'){{ '@'.'endif' }} @{{ $format->name }}</div> {{ '@'.'endforeach' }}</div>
    </div>
</div>
