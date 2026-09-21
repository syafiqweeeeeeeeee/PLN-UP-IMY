<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query()->latest();

        // Search nama / subjek
        if ($search = trim((string) $request->string('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($kategori = $request->string('kategori')->toString()) {
            $query->where('kategori', $kategori);
        }

        // Filter status
        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        $messages = $query->paginate(15)->withQueryString();

        // Statistik untuk stat cards
        $stats = [
            'total'   => ContactMessage::count(),
            'unread'  => ContactMessage::unreadCount(),
            'proses'  => ContactMessage::where('status', ContactMessage::STATUS_DIPROSES)->count(),
            'selesai' => ContactMessage::where('status', ContactMessage::STATUS_SELESAI)->count(),
        ];

        return view('admin.contact_messages.index', [
            'messages'  => $messages,
            'stats'     => $stats,
            'statusLabels' => ContactMessage::statusLabels(),
        ]);
    }

    /**
     * Data detail untuk modal (dipanggil via AJAX/fetch).
     */
    public function show(ContactMessage $contactMessage)
    {
        // Buka pesan otomatis ubah status: belum_dibaca -> diproses
        $contactMessage->markAsRead();

        return response()->json([
            'id'           => $contactMessage->id,
            'nama'         => $contactMessage->nama,
            'email'        => $contactMessage->email,
            'telepon'      => $contactMessage->telepon,
            'kategori'     => $contactMessage->kategori_label,
            'subjek'       => $contactMessage->subjek,
            'pesan'        => $contactMessage->pesan,
            'status'       => $contactMessage->status,
            'status_label' => $contactMessage->status_label,
            'tanggal'      => $contactMessage->created_at->translatedFormat('d F Y, H:i'),
            'wa_link'      => $contactMessage->wa_link,
            'mailto_link'  => $contactMessage->mailto_link,
            // Statistik terbaru (membuka pesan mengubah status jadi diproses)
            'stats'        => [
                'total'   => ContactMessage::count(),
                'unread'  => ContactMessage::unreadCount(),
                'proses'  => ContactMessage::where('status', ContactMessage::STATUS_DIPROSES)->count(),
                'selesai' => ContactMessage::where('status', ContactMessage::STATUS_SELESAI)->count(),
            ],
            'unread_count' => ContactMessage::unreadCount(),
        ]);
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', ContactMessage::STATUSES)],
        ]);

        $oldStatus = $contactMessage->status;
        $old = $contactMessage->status_label;

        $contactMessage->update([
            'status'  => $validated['status'],
            'read_at' => $validated['status'] === ContactMessage::STATUS_BELUM_DIBACA ? null : ($contactMessage->read_at ?? now()),
        ]);

        ActivityLogger::log('update', null, [
            'module'      => 'permohonan',
            'description' => "mengubah status permohonan \"{$contactMessage->subjek}\" dari {$old} menjadi {$contactMessage->status_label}",
            'subject'     => $contactMessage,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success'      => true,
                'message'      => "Status permohonan diubah menjadi {$contactMessage->status_label}.",
                'status'       => $contactMessage->status,
                'status_label' => $contactMessage->status_label,
                'old_status'   => $oldStatus,
                // Statistik global terbaru agar frontend bisa sinkron
                // stat cards & badge sidebar tanpa reload halaman.
                'stats'        => [
                    'total'   => ContactMessage::count(),
                    'unread'  => ContactMessage::unreadCount(),
                    'proses'  => ContactMessage::where('status', ContactMessage::STATUS_DIPROSES)->count(),
                    'selesai' => ContactMessage::where('status', ContactMessage::STATUS_SELESAI)->count(),
                ],
                'unread_count' => ContactMessage::unreadCount(),
            ]);
        }

        return back()->with('success', "Status permohonan diubah menjadi {$contactMessage->status_label}.");
    }

    public function destroy(ContactMessage $contactMessage)
    {
        ActivityLogger::log('delete', null, [
            'module'      => 'permohonan',
            'description' => "menghapus permohonan \"{$contactMessage->subjek}\" dari {$contactMessage->nama}",
            'subject'     => $contactMessage,
        ]);

        $subjek = $contactMessage->subjek;
        $contactMessage->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => "Permohonan \"{$subjek}\" berhasil dihapus."]);
        }

        return back()->with('success', "Permohonan \"{$subjek}\" berhasil dihapus.");
    }
}
