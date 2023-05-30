import { Link } from '@inertiajs/react';
import React from 'react';
import useRoute from '@/Hooks/useRoute';
import useTypedPage from '@/Hooks/useTypedPage';
import { Head } from '@inertiajs/react';

interface Props {
    canLogin: boolean;
    canRegister: boolean;
    laravelVersion: string;
    phpVersion: string;
}

export default function Welcome({
                                    canLogin,
                                    canRegister,
                                    laravelVersion,
                                    phpVersion,
                                }: Props) {
    const route = useRoute();
    const page = useTypedPage();

    return (
        <>
            <Head title="Welcome" />

            <div className="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                {canLogin ? (
                    <div className="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                        {page.props.auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >
                                Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                >
                                    Log in
                                </Link>

                                {canRegister ? (
                                    <Link
                                        href={route('register')}
                                        className="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                    >
                                        Register
                                    </Link>
                                ) : null}
                            </>
                        )}
                    </div>
                ) : null}

                <div className="max-w-7xl mx-auto p-6 lg:p-8">

                    <div className="mt-16">
                        <h1 className="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                            <span className="block">Vítejte na stránkách chytrenajmy.cz!</span>
                            <span className="block text-red-600">Zatím stále budujeme, ale máte se na co těšit!.</span>
                        </h1>
                    </div>

                    <div className="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                        <div className="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">

                        </div>

                        <div className="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                            Laravel v{laravelVersion} (PHP v{phpVersion})

                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
