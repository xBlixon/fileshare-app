import type file from '@/types/app/file';
export interface Share {
        id: number;
        user_id: number;
        title: string;
        description: string;
        files: file[];
};
