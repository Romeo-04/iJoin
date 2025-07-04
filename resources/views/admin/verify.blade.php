@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-3xl font-bold mb-6 text-center">🎫 Ticket Verification</h1>
                
                <div class="max-w-md mx-auto">
                    <form id="verifyForm" class="space-y-4">
                        <div>
                            <label for="ticket_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ticket Code</label>
                            <input type="text" 
                                   id="ticket_code" 
                                   name="ticket_code" 
                                   placeholder="Enter ticket code..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                   required>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">
                            Verify Ticket
                        </button>
                    </form>
                    
                    <div id="result" class="mt-6 hidden"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('verifyForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const ticketCode = document.getElementById('ticket_code').value;
    const resultDiv = document.getElementById('result');
    
    // Show loading state
    resultDiv.className = 'mt-6 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded';
    resultDiv.innerHTML = '⏳ Verifying ticket...';
    resultDiv.classList.remove('hidden');
    
    try {
        const response = await fetch('{{ route("tickets.verify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ ticket_code: ticketCode })
        });
        
        const data = await response.json();
        
        if (data.success) {
            resultDiv.className = 'mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded';
            resultDiv.innerHTML = `
                <h3 class="font-bold text-lg mb-2">✅ Ticket Verified Successfully!</h3>
                <div class="space-y-1 text-sm">
                    <p><strong>Attendee:</strong> ${data.data.user_name} (${data.data.user_email})</p>
                    <p><strong>Event:</strong> ${data.data.event_title}</p>
                    <p><strong>Event Date:</strong> ${new Date(data.data.event_date).toLocaleString()}</p>
                    <p><strong>Verified At:</strong> ${new Date(data.data.verified_at).toLocaleString()}</p>
                </div>
            `;
        } else {
            throw new Error(data.message);
        }
    } catch (error) {
        resultDiv.className = 'mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded';
        resultDiv.innerHTML = `
            <h3 class="font-bold text-lg mb-2">❌ Verification Failed</h3>
            <p>${error.message || 'Invalid ticket code or ticket not found.'}</p>
        `;
    }
    
    // Clear the form
    document.getElementById('ticket_code').value = '';
});
</script>
@endsection
