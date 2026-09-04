import { AudioLines, Clapperboard, FileText } from '@lucide/vue';
import mime from 'mime';
import getFileType from '@/functions/GetFileType';
import type file from '@/types/app/file';

export default function getFileIcon(file: file) {
    const type = getFileType(file.name);
    const mimeType = mime.getType(type) ?? '';

    if (mimeType.startsWith('video/')) {
        return Clapperboard;
    }

    if (mimeType.startsWith('audio/')) {
        return AudioLines;
    }

    return FileText;
}
